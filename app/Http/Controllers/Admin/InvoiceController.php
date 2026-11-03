<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Transaction $transaction)
    {
        // Pastikan transaksi milik user
        $transaction->load('user', 'items.product'); // asumsi relasi items dan product

        return view('admin.invoice.index', compact('transaction'));
    }
}
