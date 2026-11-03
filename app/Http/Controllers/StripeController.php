<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\StripeClient;
use Throwable;

class StripeController extends Controller
{
    public function start()
    {
        $secret = config('services.stripe.secret');
        if (!$secret) {
            return redirect()->route('cart.index')->with('error', 'Stripe belum dikonfigurasi. Isi STRIPE_SECRET di file .env.');
        }

        try {
            $transaction = DB::transaction(function () {
                $userId = auth()->id();
                $cart = Cart::with('product')->where('user_id', $userId)->lockForUpdate()->get();

                if ($cart->isEmpty()) {
                    throw new \RuntimeException('Keranjang kosong.');
                }

                $total = 0;
                foreach ($cart as $item) {
                    if (!$item->product || (int) $item->qty < 1 || (int) $item->qty > (int) $item->product->stok) {
                        throw new \RuntimeException('Stok salah satu produk tidak mencukupi.');
                    }
                    $total += round((float) $item->product->harga_akhir, 2) * (int) $item->qty;
                }

                $trx = Transaction::create([
                    'user_id' => $userId,
                    'invoice' => 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(10)),
                    'total' => round($total, 2),
                    'status' => 'pending',
                ]);

                foreach ($cart as $item) {
                    $unit = round((float) $item->product->harga_akhir, 2);
                    $trx->items()->create([
                        'product_id' => $item->product_id,
                        'qty' => (int) $item->qty,
                        'harga' => $item->product->harga,
                        'harga_akhir' => $unit,
                        'subtotal' => round($unit * (int) $item->qty, 2),
                    ]);
                }

                return $trx;
            });
        } catch (\RuntimeException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        try {
            $lineItems = $transaction->items()->with('product')->get()->map(function ($item) {
                // Stripe IDR tidak memakai pecahan; kirim nominal rupiah bulat, jangan dikali 100.
                return [
                    'price_data' => [
                        'currency' => 'idr',
                        'product_data' => ['name' => $item->product->judul ?? 'Produk'],
                        'unit_amount' => (int) round((float) $item->harga_akhir),
                    ],
                    'quantity' => (int) $item->qty,
                ];
            })->all();

            $stripe = new StripeClient($secret);
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'client_reference_id' => (string) $transaction->id,
                'metadata' => [
                    'transaction_id' => (string) $transaction->id,
                    'invoice' => $transaction->invoice,
                ],
                'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel').'?transaction='.$transaction->id,
            ]);

            $transaction->update(['stripe_session_id' => $session->id]);

            // Cart baru dihapus setelah sesi pembayaran berhasil dibuat.
            Cart::where('user_id', auth()->id())->delete();

            return redirect()->away($session->url);
        } catch (Throwable $e) {
            report($e);
            $transaction->update(['status' => 'failed']);
            return redirect()->route('cart.index')
                ->with('error', 'Tidak dapat memulai pembayaran. Periksa konfigurasi Stripe dan coba lagi.');
        }
    }

    public function success()
    {
        $sessionId = request('session_id');
        $secret = config('services.stripe.secret');

        if (!$sessionId || !$secret) {
            return redirect()->route('transactions.history')->with('error', 'Sesi pembayaran tidak valid.');
        }

        try {
            $stripe = new StripeClient($secret);
            $session = $stripe->checkout->sessions->retrieve($sessionId, []);
            $transaction = Transaction::where('stripe_session_id', $sessionId)->firstOrFail();

            abort_unless(
                (int) $transaction->user_id === (int) auth()->id() || auth()->user()->isAdmin(),
                403
            );

            $amountMatches = (int) $session->amount_total === (int) round((float) $transaction->total);
            $isPaid = $session->payment_status === 'paid'
                && strtolower((string) $session->currency) === 'idr'
                && $amountMatches;

            if ($isPaid && $transaction->status !== 'paid') {
                DB::transaction(function () use ($transaction) {
                    $locked = Transaction::whereKey($transaction->id)->lockForUpdate()->firstOrFail();

                    // Hindari pengurangan stok dua kali saat halaman success direfresh.
                    if ($locked->status === 'paid') {
                        return;
                    }

                    $locked->load('items');
                    foreach ($locked->items as $item) {
                        $product = Product::whereKey($item->product_id)->lockForUpdate()->first();
                        if (!$product || (int) $product->stok < (int) $item->qty) {
                            throw new \RuntimeException('Stok tidak mencukupi untuk menyelesaikan transaksi.');
                        }
                    }

                    foreach ($locked->items as $item) {
                        Product::whereKey($item->product_id)->decrement('stok', (int) $item->qty);
                    }

                    $locked->update(['status' => 'paid', 'paid_at' => now()]);
                });
            }

            $transaction->refresh()->load('items.product');
            return view('checkout.success', ['trx' => $transaction]);
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('transactions.history')->with('error', 'Status pembayaran belum dapat diverifikasi. Jika saldo terpotong, hubungi admin.');
        }
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
