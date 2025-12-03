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

/* CSS UNTUK WRAPPER FORM */
.form-scrollable-wrapper {
    /* form lebih tinggi */
    max-height: 85vh; 
    
    /* Mengaktifkan vertical scroll */
    overflow-y: auto; 
    
    /* Memberi sedikit padding di kanan agar konten tidak terlalu mepet tepi */
    padding-right: 15px;
}

/* CSS MEMBATASI LEBAR FORM  */
.form-produk-pendek {
    /* Lebar form */
    max-width: 450px; 
}

/* Style untuk preview gambar */
.image-preview {
    max-width: 100%;
    max-height: 200px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 5px;
    display: none;
}

.drive-help {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 5px;
}
</style>

<div class="container mt-4">
    
    <div class="row d-flex align-items-center">

        <div class="col-md-4">
            <h1>Tambah Produk</h1>
        </div>

        <div class="col-md-8">
            
            <form class="form-produk-pendek" action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="form-scrollable-wrapper hidden-scroll"> 

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
                        <label for="stok">Stok Awal</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" min="0"> 
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" class="form-control" value="{{ old('diskon') }}" min="0" max="100">
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
                        <label for="image_url">URL Gambar dari Google Drive</label>
                        <input type="url" name="image_url" id="image_url" class="form-control" 
                               value="{{ old('image_url') }}" 
                               placeholder="https://lh3.googleusercontent.com/d/FILE_ID"
                               onchange="previewImage(this.value)">
                        
                        <div class="drive-help">
                            <small>
                                Cara dapatkan URL: 
                                <ol>
                                    <li>Upload gambar ke Google Drive</li>
                                    <li>Klik kanan file → "Dapatkan link"</li>
                                    <li>Setel akses menjadi "Siapa saja dengan link"</li>
                                    <li>Salin link dan tempel di sini</li>
                                </ol>
                            </small>
                        </div>

                        <!-- Preview Gambar -->
                        <img id="image_preview" class="image-preview" alt="Preview Gambar">
                    </div>
                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali</a>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

<script>
function previewImage(url) {
    const preview = document.getElementById('image_preview');
    
    if (url) {
        // Konversi URL Google Drive ke format direct link untuk preview
        let directUrl = url;
        
        // Jika URL dalam format view
        if (url.includes('/file/d/')) {
            const match = url.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
            if (match) {
                directUrl = "https://drive.google.com/uc?id=" + match[1];
            }
        }
        // Jika URL dalam format open
        else if (url.includes('id=')) {
            const match = url.match(/id=([a-zA-Z0-9_-]+)/);
            if (match) {
                directUrl = "https://drive.google.com/uc?id=" + match[1];
            }
        }
        
        preview.src = directUrl;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}

// Preview gambar saat halaman load jika ada value sebelumnya
document.addEventListener('DOMContentLoaded', function() {
    const initialUrl = document.getElementById('image_url').value;
    if (initialUrl) {
        previewImage(initialUrl);
    }
});
</script>
@endsection