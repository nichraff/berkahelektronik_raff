<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cart->sum(fn ($item) => (float) $item->harga_akhir * (int) $item->qty);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ((int) $product->stok < 1) {
            return back()->with('error', 'Stok produk sedang habis.');
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        $newQty = (int) ($cart?->qty ?? 0) + 1;
        if ($newQty > (int) $product->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $values = [
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'qty' => $newQty,
            'harga' => $product->harga,
            // Simpan harga satuan, bukan total baris.
            'harga_akhir' => round((float) $product->harga_akhir, 2),
        ];

        if ($cart) {
            $cart->update($values);
        } else {
            Cart::create($values);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, Cart $cart)
    {
        abort_unless((int) $cart->user_id === (int) auth()->id(), 403);

        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:999'],
        ]);

        $product = $cart->product;
        if (!$product || (int) $data['qty'] > (int) $product->stok) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart->update([
            'qty' => (int) $data['qty'],
            'harga' => $product->harga,
            'harga_akhir' => round((float) $product->harga_akhir, 2),
        ]);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function delete(Cart $cart)
    {
        abort_unless((int) $cart->user_id === (int) auth()->id(), 403);

        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
