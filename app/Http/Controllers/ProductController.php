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
    public function index(): View
    {
        $products = Product::latest()->paginate(20); 
        return view('products.index', compact('products'))
               ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function create(): View
    {
        $categories = Category::all(); 
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
    $request->validate([
        'kategori' => 'required|exists:categories,id', 
        'brand' => 'required|max:255',
        'judul' => 'required|max:255',    
        'model' => 'required|max:255',
        'stok' => 'required|integer|min:0',     
        'harga' => 'required|numeric|min:0', 
        'diskon' => 'nullable|integer|min:0|max:100', 
        'garansi' => 'nullable|max:255',
        'detail' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
        }

    $data = $request->except(['image', '_token']); 

    $data['image'] = $imageName;
    $data['diskon'] = $request->diskon ?? 0;
    $data['stok'] = $request->stok ?? 0;

    Product::create($data); 

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
        }
        
        public function edit(Product $product): View
        {
            $categories = Category::all(); 
            return view('products.edit', compact('product', 'categories'));
        }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|exists:categories,id', 
            'brand' => 'required|max:255',
            'judul' => 'required|max:255',   
            'model' => 'required|max:255',
            'tambah_stok' => 'nullable|integer|min:0',
            'harga' => 'required|numeric|min:0', 
            'diskon' => 'nullable|integer|min:0|max:100', 
            'garansi' => 'nullable|max:255',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = $request->except('image', '_token', '_method', 'tambah_stok'); 
        $stok_sekarang = $product->stok; 

        if ($request->filled('tambah_stok')) {
            $stok_terbaru = $stok_sekarang + $request->tambah_stok;
            $data['stok'] = $stok_terbaru; 
        } else {
            $data['stok'] = $stok_sekarang;
        }

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('products', $imageName, 'public');
        }

        $product->update($request->except('image', '_token', '_method') + ['image' => $imageName, 'diskon' => $request->diskon ?? 0]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }
   


    public function destroy(Product $product): RedirectResponse
    {
    if ($product->image) {
        Storage::delete('public/products/' . $product->image);
    }
   
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}