@extends('products.layout')
 
@section('content')

<style>
/* Menonaktifkan panah pada input number */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}

/* CSS UNTUK WRAPPER FORM (Tinggi dan Scroll) */
.form-scrollable-wrapper {
    /* Mengambil 85% tinggi layar di bawah navbar */
    max-height: 85vh; 
    
    /* Mengaktifkan vertical scroll */
    overflow-y: auto; 
    
    /* Memberi sedikit padding di kanan */
    padding-right: 15px;
}

/* CSS MEMBATASI LEBAR FORM */
.form-produk-pendek {
    /* Lebar form  */
    max-width: 450px; 
}
</style>


<div class="container mt-4">
    
    <div class="row d-flex align-items-center">

        <div class="col-md-4">
            <h1>Edit Produk</h1>
        </div>

        <div class="col-md-8">
            
            <form class="form-produk-pendek" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                
                <div class="form-scrollable-wrapper hidden-scroll"> 
                    @csrf
                    @method('PUT') 
                    
                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="kategori" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{-- LOGIKA SELEKSI: Cek apakah ID kategori cocok dengan data lama (old) atau data produk saat ini ($product) --}}
                                    {{ old('kategori', $product->kategori) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="brand">Brand</label>
                        <input type="text" name="brand" class="form-control" placeholder="Masukkan Brand" 
                                value="{{ old('brand', $product->brand) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="judul">Judul Produk</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Produk" 
                                value="{{ old('judul', $product->judul) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="model">Model</label>
                        <input type="text" name="model" class="form-control" placeholder="Masukkan Model" 
                                value="{{ old('model', $product->model) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stok_saat_ini">Stok Saat Ini</label>
                        <input type="number" class="form-control" value="{{ $product->stok }}" disabled> 
                    </div>

                    <div class="form-group mb-3">
                        <label for="tambah_stok">Jumlah Stok Baru</label>
                        <input type="number" name="tambah_stok" class="form-control" min="0"> 
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" step="0.01" placeholder="Masukkan Harga" 
                                value="{{ old('harga', $product->harga) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" class="form-control" placeholder="Masukkan Diskon (0-100)" 
                                value="{{ old('diskon', $product->diskon) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="garansi">Garansi</label>
                        <input type="text" name="garansi" class="form-control" placeholder="Masukkan Masa Garansi" 
                                value="{{ old('garansi', $product->garansi) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="detail">Detail Produk</label>
                        <textarea name="detail" class="form-control" placeholder="Masukkan Detail Produk">{{ old('detail', $product->detail) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
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

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali</a>
                    </div>

                </div> </form>
        </div>

    </div>
</div>
@endsection