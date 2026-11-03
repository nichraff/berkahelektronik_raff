@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Pembayaran Berhasil!</h2>
    <p>Invoice: <strong>{{ $trx->invoice }}</strong></p>
    <p>Total: <strong>Rp {{ number_format($trx->total, 0, ',', '.') }}</strong></p>

    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Kembali Belanja</a>
</div>
@endsection
