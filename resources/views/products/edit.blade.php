@extends('products.layout')
  
@section('content')

<div class="card mt-5">
  <h2 class="card-header">Edit Product</h2>
  <div class="card-body">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <div class="form-group">
        

<label for="kategori">Kategori</label>
<select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
    <option value="">Pilih Kategori</option>
    @php
        // Ganti array statis $categories dengan mengambil dari variabel $categories 
        // yang dilempar dari controller (yang sudah berisi objek Category dari DB)
        // Hapus baris ini: $categories = ['TV', 'AC', 'Proyektor']; 
    @endphp
    
    {{-- $categories sudah diambil di ProductController::edit() --}}
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{-- FIX: Ganti $category menjadi $category->id --}}
            {{ old('kategori', $product->kategori) == $category->id ? 'selected' : '' }}> {{-- FIX: Bandingkan dengan $category->id --}}
            {{ $category->name }}
        </option>
    @endforeach
</select>
{{-- ... error handling ... --}}
    </div>

    <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" name="brand" class="form-control" placeholder="Masukkan Brand" 
               value="{{ old('brand', $product->brand) }}">
    </div>

    <div class="form-group">
        <label for="judul">Judul Produk</label>
        <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Produk" 
               value="{{ old('judul', $product->judul) }}">
    </div>

    <div class="form-group">
        <label for="model">Model</label>
        <input type="text" name="model" class="form-control" placeholder="Masukkan Model" 
               value="{{ old('model', $product->model) }}">
    </div>

    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" class="form-control" step="0.01" placeholder="Masukkan Harga" 
               value="{{ old('harga', $product->harga) }}">
    </div>

    <div class="form-group">
        <label for="diskon">Diskon (%)</label>
        <input type="number" name="diskon" class="form-control" placeholder="Masukkan Diskon (0-100)" 
               value="{{ old('diskon', $product->diskon) }}">
    </div>

    <div class="form-group">
        <label for="garansi">Garansi</label>
        <input type="text" name="garansi" class="form-control" placeholder="Masukkan Masa Garansi" 
               value="{{ old('garansi', $product->garansi) }}">
    </div>

    <div class="form-group">
        <label for="detail">Detail Produk</label>
        <textarea name="detail" class="form-control" placeholder="Masukkan Detail Produk">{{ old('detail', $product->detail) }}</textarea>
    </div>

    <div class="form-group">
        <label>Gambar Saat Ini:</label>
        @if($product->image)
            <img src="{{ Storage::url('public/products/'.$product->image) }}" alt="{{ $product->judul }}" style="width: 150px; display: block; margin-bottom: 10px;">
        @else
            <p>Tidak ada gambar tersimpan.</p>
        @endif
        
        <label for="image">Ganti Gambar Produk (kosongkan jika tidak diubah)</label>
        <input type="file" name="image" class="form-control">
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali</a>
</form>

  </div>
</div>
@endsection