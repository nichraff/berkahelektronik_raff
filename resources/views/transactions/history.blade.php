@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Riwayat Transaksi</h2>

    @if ($transactions->count() == 0)
        <div class="alert alert-info">
            Belum ada transaksi.
        </div>
    @endif

    @foreach ($transactions as $trx)
        <div class="card mb-3">
            <div class="card-header">
                <strong>ID Transaksi:</strong> {{ $trx->id }}  
                <span class="float-end">{{ $trx->created_at->format('d M Y H:i') }}</span>
            </div>

            <div class="card-body">
                <p><strong>Total:</strong> Rp {{ number_format($trx->total, 0, ',', '.') }}</p>

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trx->items as $item)
                            <tr>
                                <td>{{ $item->product->judul ?? 'Produk dihapus' }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endforeach

</div>
@endsection
