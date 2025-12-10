@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Keranjang Belanja</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cart->count() == 0)
        <div class="alert alert-info">
            Keranjang masih kosong.
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Belanja Sekarang</a>
    @else

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>
                    <strong>{{ $item->product->judul }}</strong> <br>
                    <small>{{ $item->product->brand }} - {{ $item->product->model }}</small>
                </td>

                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                <td style="width: 140px;">
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="input-group input-group-sm">
                            <input type="number" name="qty" value="{{ $item->qty }}" min="1" class="form-control">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </td>

                <td>
                    <strong>Rp {{ number_format($item->harga_akhir, 0, ',', '.') }}</strong>
                </td>

                <td>
                    <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini?')">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4>Total Bayar: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></h4>

        <a href="{{ route('checkout.start') }}" class="btn btn-success btn-lg mt-3">
            Checkout & Bayar
        </a>
    </div>

    @endif

</div>
@endsection
