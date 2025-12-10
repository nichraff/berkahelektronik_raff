<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // proses checkout sekali bayar
    public function checkout()
    {
        $cart = Cart::with('product')->get();

        if ($cart->count() == 0) {
            return back()->with('error', 'Cart masih kosong.');
        }

        // hitung total
        $total = $cart->sum(function($item) {
            return $item->qty * $item->harga_akhir;
        });

        // buat transaksi
        $transaction = Transaction::create([
            'invoice' => 'INV-' . Str::upper(Str::random(8)),
            'total'   => $total,
            'status'  => 'pending'
        ]);

        // pindahkan semua item cart ke transaction_items
        foreach ($cart as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item->product_id,
                'qty'            => $item->qty,
                'harga'          => $item->harga,
                'harga_akhir'    => $item->harga_akhir,
                'subtotal'       => $item->qty * $item->harga_akhir,
            ]);
        }

        // kosongkan cart
        Cart::truncate();

        return redirect()->route('transactions.show', $transaction->id)
            ->with('success', 'Checkout berhasil, silakan lanjut bayar.');
    }

    // tampilkan detail transaksi
    public function show(Transaction $transaction)
    {
        $transaction->load('items.product');
        return view('transactions.show', compact('transaction'));
    }

    // tampilkan riwayat transaksi
    public function history()
    {
        $transactions = Transaction::with('items.product')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.history', compact('transactions'));
    }

}
