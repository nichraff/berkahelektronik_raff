<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Jangan lupa import model Product

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data produk untuk ditampilkan di dashboard
        $products = Product::all(); // Atau gunakan pagination/query khusus
        
        // Jika ingin produk dengan diskon atau produk terbaru:
        // $products = Product::where('diskon', '>', 0)->get();
        // $products = Product::latest()->take(8)->get();
        
        return view('customers.dashboard.index', compact('products'));
    }
}