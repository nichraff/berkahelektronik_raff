@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Pembayaran Dibatalkan</h2>
    <p>Transaksi tidak berhasil.</p>

    <a href="{{ route('cart.index') }}" class="btn btn-warning mt-3">Kembali ke Keranjang</a>
</div>
@endsection
