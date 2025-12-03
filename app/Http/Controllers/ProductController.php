<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
   public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

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
    // PENCARIAN PRODUK DENGAN HIGHLIGHT
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
            'image_url' => 'required|url|max:500', // Validasi URL gambar dari Drive
        ]);

        // Konversi URL Google Drive ke format yang bisa di-embed
        $imageUrl = $this->convertDriveUrl($request->image_url);

        // Simpan data - PASTIKAN SEMUA FIELD ADA
        $data = [
            'kategori' => $request->kategori,
            'brand'    => $request->brand,
            'judul'    => $request->judul,
            'model'    => $request->model,
            'stok'     => $request->stok,
            'harga'    => $request->harga,
            'diskon'   => $request->diskon ?? 0,
            'garansi'  => $request->garansi,
            'detail'   => $request->detail,
            'image'    => $imageUrl,
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
            'kategori' => 'required|exists:categories,id',
            'brand'    => 'required|max:255',
            'judul'    => 'required|max:255',
            'model'    => 'required|max:255',
            'tambah_stok' => 'nullable|integer|min:0',
            'harga'    => 'required|numeric|min:0',
            'diskon'   => 'nullable|integer|min:0|max:100',
            'garansi'  => 'nullable|max:255',
            'detail'   => 'required',
            'image_url' => 'nullable|url|max:500', // Validasi URL gambar dari Drive
        ]);

        // Data kecuali image_url & stok tambahan
        $data = $request->except(['image_url', 'tambah_stok']);

        // Update stok
        $data['stok'] = $product->stok + ($request->tambah_stok ?? 0);

        // Update gambar jika ada URL baru
        if ($request->has('image_url') && !empty($request->image_url)) {
            $data['image'] = $this->convertDriveUrl($request->image_url);
        }

        // Default diskon
        $data['diskon'] = $request->diskon ?? 0;

        // Update data
        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    // ===================================================
    // HAPUS PRODUK
    // ===================================================
    public function destroy(Product $product): RedirectResponse
    {
        // Hapus data di database (tidak perlu hapus file karena menggunakan URL Drive)
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // ===================================================
    // FUNGSI UNTUK KONVERSI URL GOOGLE DRIVE
    // ===================================================
    private function convertDriveUrl($url)
    {
        // Jika URL kosong, return kosong
        if (empty($url)) {
            return $url;
        }

        // Jika sudah format googleusercontent, keep as is
        if (str_contains($url, 'googleusercontent.com')) {
            return $url;
        }

        // Extract file ID dari berbagai format
        $fileId = null;
        
        // Format 1: https://drive.google.com/file/d/FILE_ID/view
        if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }
        // Format 2: https://drive.google.com/uc?id=FILE_ID
        elseif (preg_match('/[?&]id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }
        // Format 3: https://drive.google.com/open?id=FILE_ID
        elseif (preg_match('/open\?id=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            $fileId = $matches[1];
        }

        // Jika dapat file ID, konversi ke googleusercontent
        if ($fileId) {
            return "https://lh3.googleusercontent.com/d/" . $fileId;
        }

        // Jika tidak match, return URL asli
        return $url;
    }
}