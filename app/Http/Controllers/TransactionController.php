<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class TransactionController extends Controller
{
    public function checkout()
    {
        $userId = auth()->id();

        try {
            $transaction = DB::transaction(function () use ($userId) {
                $cart = Cart::with('product')
                    ->where('user_id', $userId)
                    ->lockForUpdate()
                    ->get();

                if ($cart->isEmpty()) {
                    throw new RuntimeException('Keranjang masih kosong.');
                }

                $total = 0;
                foreach ($cart as $item) {
                    if (!$item->product || (int) $item->qty < 1) {
                        throw new RuntimeException('Ada produk yang sudah tidak tersedia.');
                    }
                    if ((int) $item->qty > (int) $item->product->stok) {
                        throw new RuntimeException('Stok tidak mencukupi untuk produk: '.$item->product->judul);
                    }
                    $total += round((float) $item->product->harga_akhir, 2) * (int) $item->qty;
                }

                $transaction = Transaction::create([
                    'user_id' => $userId,
                    'invoice' => 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(10)),
                    'total' => round($total, 2),
                    'status' => 'pending',
                ]);

                foreach ($cart as $item) {
                    $unit = round((float) $item->product->harga_akhir, 2);
                    $transaction->items()->create([
                        'product_id' => $item->product_id,
                        'qty' => (int) $item->qty,
                        'harga' => $item->product->harga,
                        'harga_akhir' => $unit,
                        'subtotal' => round($unit * (int) $item->qty, 2),
                    ]);
                }

                // Jangan hapus cart global; hapus hanya milik user ini.
                Cart::where('user_id', $userId)->delete();

                return $transaction;
            });
        } catch (RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Checkout berhasil. Silakan lanjutkan pembayaran jika diperlukan.');
    }

    public function show(Transaction $transaction)
    {
        abort_unless(
            (int) $transaction->user_id === (int) auth()->id() || auth()->user()->isAdmin(),
            403
        );

        $transaction->load('items.product', 'user');

        return view('transactions.show', compact('transaction'));
    }

    public function history()
    {
        $transactions = Transaction::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('transactions.history', compact('transactions'));
    }
}
