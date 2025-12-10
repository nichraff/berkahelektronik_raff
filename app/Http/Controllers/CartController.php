<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // ============================
    // TAMPILKAN KERANJANG
    // ============================
    public function index()
    {
        $cart = Cart::with('product')->get();
        $total = $cart->sum('harga_akhir');

        return view('cart.index', compact('cart', 'total'));
    }

    // ============================
    // TAMBAH PRODUK KE CART
    // ============================
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // hitung harga akhir (diskon)
        $hargaAkhir = $product->harga - ($product->harga * $product->diskon / 100);

        // cek jika sudah ada di cart
        $cart = Cart::where('product_id', $productId)->first();

        if ($cart) {
            // tambah qty
            $cart->qty += 1;
            $cart->harga_akhir = $cart->qty * $hargaAkhir;
            $cart->save();
        } else {
            // buat cart baru
            Cart::create([
                'product_id' => $productId,
                'qty' => 1,
                'harga' => $product->harga,
                'harga_akhir' => $hargaAkhir,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // ============================
    // UPDATE QTY (TAMBAH/KURANG)
    // ============================
    public function update(Request $request, Cart $cart)
    {
        $product = $cart->product;

        $cart->qty = $request->qty;
        $cart->harga_akhir = $cart->qty * ($product->harga - ($product->harga * $product->diskon / 100));
        $cart->save();

        return back()->with('success', 'Keranjang diperbarui.');
    }

    // ============================
    // HAPUS PRODUK DARI CART
    // ============================
    public function delete(Cart $cart)
    {
        $cart->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
