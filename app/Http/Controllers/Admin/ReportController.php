<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index()
    {
        // Total transaksi
        $totalTransaksi = Transaction::count();

        // Total pendapatan
        $totalPendapatan = Transaction::sum('total');

        // Transaksi terbaru (5 terakhir)
        $latestTransactions = Transaction::latest()->take(5)->get();

        return view('admin.report.index', compact(
            'totalTransaksi',
            'totalPendapatan',
            'latestTransactions'
        ));
    }
}
