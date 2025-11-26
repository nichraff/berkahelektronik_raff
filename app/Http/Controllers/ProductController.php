<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ===================================================
    // LIST PRODUK
    // ===================================================
    public function index(Request $request): View
    {
        // 1. Ambil keyword dari request. Menggunakan 'keyword' sesuai dengan nama input di form Navbar.
        $keyword = $request->input('keyword'); 

        // 2. Query produk + filter judul jika ada pencarian
        $products = Product::when($keyword, function ($query, $keyword) {
            // Menggunakan LIKE dengan wildcard (%) untuk pencarian yang fleksibel di kolom 'judul'
            return $query->where('judul', 'like', '%' . $keyword . '%');
        })
        ->latest()
        // 3. Penting: Tambahkan withQueryString() agar link pagination membawa keyword pencarian
        ->paginate(20)
        ->withQueryString(); 

        // 4. Mengirim keyword (opsional, tapi baik untuk menampilkan status pencarian)
        return view('products.index', compact('products', 'keyword')) 
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }


    // ===================================================
    // TAMPILKAN FORM TAMBAH
    // ===================================================
    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // ===================================================
    // STORE / SIMPAN PRODUK
    // ===================================================
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|exists:categories,id',
            'brand'    => 'required|max:255',
            'judul'    => 'required|max:255',
            'model'    => 'required|max:255',
            'stok'     => 'required|integer|min:0',
            'harga'    => 'required|numeric|min:0',
            'diskon'   => 'nullable|integer|min:0|max:100',
            'garansi'  => 'nullable|max:255',
            'detail'   => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload gambar
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('products', $imageName, 'public');
        }

        // Simpan data
        $data = $request->except('image');
        $data['image']  = $imageName;
        $data['diskon'] = $request->diskon ?? 0;

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    // ===================================================
    // EDIT PRODUK
    // ===================================================
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // ===================================================
    // UPDATE PRODUK
    // ===================================================
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|exists:categories,id',
            'brand'    => 'required|max:255',
            'judul'    => 'required|max:255',
            'model'    => 'required|max:255',
            'tambah_stok' => 'nullable|integer|min:0',
            'harga'    => 'required|numeric|min:0',
            'diskon'   => 'nullable|integer|min:0|max:100',
            'garansi'  => 'nullable|max:255',
            'detail'   => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Data kecuali image & stok tambahan
        $data = $request->except(['image', 'tambah_stok']);

        // Update stok
        $data['stok'] = $product->stok + ($request->tambah_stok ?? 0);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('products', $imageName, 'public');
            $data['image'] = $imageName;
        }

        // Default diskon
        $data['diskon'] = $request->diskon ?? 0;

        // Update data
        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // ===================================================
    // HAPUS PRODUK + GAMBAR
    // ===================================================
    public function destroy(Product $product): RedirectResponse
    {
        // Hapus file gambar
        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        // Hapus data di database
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}