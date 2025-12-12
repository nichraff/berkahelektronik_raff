@extends('products.layout')

@section('content')

<h4 class="fw-bold mb-3">Tambah Produk</h4>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label for="category_id">Kategori</label>
        <select name="category_id" class="form-control">
            <option value="">Pilih Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Brand</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
    </div>

    <div class="mb-3">
        <label>Judul Produk</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
    </div>

    <div class="mb-3">
        <label>Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model') }}">
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" min="0">
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" step="0.01">
    </div>

    <div class="mb-3">
        <label>Diskon (%)</label>
        <input type="number" name="diskon" class="form-control" value="{{ old('diskon') }}" min="0" max="100">
    </div>

    <div class="mb-3">
        <label>Garansi</label>
        <input type="text" name="garansi" class="form-control" value="{{ old('garansi') }}">
    </div>

    <div class="mb-3">
        <label>Detail Produk</label>
        <textarea name="detail" class="form-control" rows="3">{{ old('detail') }}</textarea>
    </div>

    <div class="mb-3">
        <label>URL Gambar Google Drive (optional)</label>
        <input type="url" name="image_url" id="image_url" class="form-control"
               placeholder="https://drive.google.com/uc?id=FILE_ID"
               onchange="previewImage(this.value)">
        <img id="image_preview" class="product-image mt-2" style="display:none;">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali</a>
</form>

<script>
function previewImage(url) {
    const preview = document.getElementById('image_preview');
    if(url && url.includes('drive.google.com')) {
        let directUrl = url;
        if(url.includes('/file/d/')) {
            const match = url.match(/\/file\/d\/([a-zA-Z0-9_-]+)/);
            if(match) directUrl = "https://drive.google.com/uc?id=" + match[1];
        } else if(url.includes('id=')) {
            const match = url.match(/id=([a-zA-Z0-9_-]+)/);
            if(match) directUrl = "https://drive.google.com/uc?id=" + match[1];
        }
        preview.src = directUrl;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
}
</script>

@endsection
