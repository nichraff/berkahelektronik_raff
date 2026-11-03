@extends('dashboard') <!-- Layout admin -->

@section('title', 'Invoice #' . $transaction->id)

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Invoice #{{ $transaction->id }}</h2>

    <div class="card p-4">
        <div class="mb-3">
            <strong>Pelanggan:</strong> {{ $transaction->user->name ?? 'Tidak Diketahui' }}<br>
            <strong>Email:</strong> {{ $transaction->user->email ?? '-' }}<br>
            <strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong>Rp {{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-end mt-3">
            <button class="btn btn-primary" onclick="window.print()">Cetak Invoice</button>
        </div>
    </div>
</div>
@endsection
