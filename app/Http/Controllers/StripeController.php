<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;

class StripeController extends Controller
{
    // ===============================
    // MULAI CHECKOUT
    // ===============================
    public function start()
    {
        $cart = Cart::with('product')->get();

        if ($cart->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $lineItems = [];
        $total = 0;

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'idr',
                    'product_data' => [
                        'name' => $item->product->judul,
                    ],
                    'unit_amount' => intval($item->harga_akhir * 100), // Convert ke sen
                ],
                'quantity' => $item->qty,
            ];

            $total += $item->harga_akhir;
        }

        // Set API key stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Buat session pembayaran
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        // Simpan transaksi sementara
        $transaction = Transaction::create([
            'invoice' => 'INV-' . now()->timestamp,
            'total' => $total,
            'status' => 'pending',
            'stripe_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }

    // ===============================
    // SUKSES
    // ===============================
    public function success()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = request('session_id');

        if (!$sessionId) {
            return redirect()->route('cart.index')
                ->with('error', 'Pembayaran tidak valid.');
        }

        // Cari transaksi
        $trx = Transaction::where('stripe_session_id', $sessionId)->first();

        if (!$trx) {
            return redirect()->route('cart.index')
                ->with('error', 'Transaksi tidak ditemukan.');
        }

        // Update transaksi → paid
        $trx->status = 'paid';
        $trx->save();

        // Simpan transaction items
        $cart = Cart::with('product')->get();

        foreach ($cart as $item) {
            TransactionItem::create([
                'transaction_id' => $trx->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'harga' => $item->harga,
                'harga_akhir' => $item->harga_akhir,
                'subtotal' => $item->qty * $item->harga_akhir,
            ]);
        }

        // Hapus cart
        Cart::truncate();

        return view('checkout.success', compact('trx'));
    }

    // ===============================
    // DIBATALKAN
    // ===============================
    public function cancel()
    {
        return view('checkout.cancel');
    }
}
