@extends('layouts.app')

@section('content')

<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}
</style>


<div class="container">
    <h1 style="text-align: center;">Tambah Produk</h1>

    <form style="max-width: 500px; margin: 0 auto;" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="category_id">Kategori</label>
            <select name="kategori" id="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
        </div>

        <div class="form-group mb-3">
            <label for="judul">Nama Produk</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
        </div>

        <div class="form-group mb-3">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" value="{{ old('model') }}">
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
        </div>

        <div class="form-group mb-3">
            <label for="diskon">Diskon (%)</label>
            <input type="number" name="diskon" class="form-control" value="{{ old('diskon', 0) }}">
        </div>

        <div class="form-group mb-3">
            <label for="garansi">Garansi</label>
            <input type="text" name="garansi" class="form-control" value="{{ old('garansi') }}">
        </div>

        <div class="form-group mb-3">
            <label for="detail">Detail Produk</label>
            <textarea name="detail" class="form-control" rows="3">{{ old('detail') }}</textarea>
        </div>

        <div class="form-group mb-4">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali</a>

    </form>
</div>
@endsection
