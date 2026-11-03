<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct()
    {
        // Middleware untuk admin di route admin/products/*
        $this->middleware(function ($request, $next) {
            if ($request->is('admin/products*')) {
                if (!auth()->check() || auth()->user()->role !== 'admin') {
                    return redirect()->route('user.dashboard')
                        ->with('error', 'Hanya admin yang bisa mengakses halaman produk');
                }
            }
            return $next($request);
        })->except(['show']);
    }

    // ===================================================
    // DETAIL PRODUK
    // ===================================================
    public function show(Product $product)
    {
        return view('customers.dashboard.detail', compact('product'));
    }

    // ===================================================
    // LIST PRODUK
    // ===================================================
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');

        $products = Product::when($keyword, function ($query, $keyword) {
            return $query->where('judul', 'like', '%' . $keyword . '%');
        })
        ->latest()
        ->paginate(20)
        ->withQueryString();

        return view('products.index', compact('products', 'keyword'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    // ===================================================
    // PENCARIAN PRODUK
    // ===================================================
    public function search(Request $request): View
    {
        $keyword = $request->input('keyword', '');

        $products = Product::when($keyword, function ($query, $keyword) {
            return $query->where('judul', 'like', '%' . $keyword . '%')
                        ->orWhere('brand', 'like', '%' . $keyword . '%')
                        ->orWhere('model', 'like', '%' . $keyword . '%');
        })
        ->latest()
        ->paginate(20)
        ->withQueryString();

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
    // STORE PRODUK
    // ===================================================
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand'       => 'required|max:255',
            'judul'       => 'required|max:255',
            'model'       => 'required|max:255',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'diskon'      => 'nullable|integer|min:0|max:100',
            'garansi'     => 'nullable|max:255',
            'detail'      => 'required',
            'image_url'   => 'required|url|max:500',
        ]);

        $imageUrl = $this->convertDriveUrl($request->image_url);

        $data = [
            'category_id' => $request->category_id,
            'brand'       => $request->brand,
            'judul'       => $request->judul,
            'model'       => $request->model,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'diskon'      => $request->diskon ?? 0,
            'garansi'     => $request->garansi,
            'detail'      => $request->detail,
            'image_url'   => $imageUrl,
        ];

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
            'category_id' => 'required|exists:categories,id',
            'brand'       => 'required|max:255',
            'judul'       => 'required|max:255',
            'model'       => 'required|max:255',
            'tambah_stok' => 'nullable|integer|min:0',
            'harga'       => 'required|numeric|min:0',
            'diskon'      => 'nullable|integer|min:0|max:100',
            'garansi'     => 'nullable|max:255',
            'detail'      => 'required',
            'image_url'   => 'nullable|url|max:500',
        ]);

        $data = $request->except(['tambah_stok', 'image_url']);

        // update stok kumulatif
        $data['stok'] = $product->stok + ($request->tambah_stok ?? 0);

        // update kategori
        $data['category_id'] = $request->category_id;

        // update gambar (jika diganti)
        if ($request->image_url) {
            $data['image_url'] = $this->convertDriveUrl($request->image_url);
        }

        // default diskon = 0 jika kosong
        $data['diskon'] = $request->diskon ?? 0;

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // ===================================================
    // HAPUS PRODUK
    // ===================================================
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // ===================================================
    // KONVERSI URL GOOGLE DRIVE KE GOOGLEUSERCONTENT
    // ===================================================
    private function convertDriveUrl($url)
    {
        if (empty($url)) {
            return $url;
        }

        if (str_contains($url, 'googleusercontent.com')) {
            return $url;
        }

        $fileId = null;

        if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        } elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        } elseif (preg_match('/open\?id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }

        if ($fileId) {
            return "https://lh3.googleusercontent.com/d/" . $fileId;
        }

        return $url;
    }
}
