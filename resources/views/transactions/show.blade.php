@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Detail Transaksi #{{ $transaction->id }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ $transaction->status ?? 'Belum dibayar' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Daftar Produk</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->items as $item)
                        <tr>
                            <td>{{ $item->product->judul ?? 'Produk dihapus' }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('checkout.start') }}" class="btn btn-secondary mt-3">Kembali ke Riwayat Transaksi</a>

</div>
@endsection
