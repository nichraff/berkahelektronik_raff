@extends('products.layout')

@section('content')

<h4 class="fw-bold mt-1 mb-3" style="font-size: 25px;">
    Barang Berkah Elektronik
</h4>

<div style="text-align: right; margin-bottom: 15px;">
  <a class="btn btn-success" href="{{ route('products.create') }}" style="border-radius: 8px;">
      <i class="fas fa-plus"></i> Tambah Produk
  </a>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(isset($keyword) && $keyword)
<div class="alert alert-info alert-dismissible fade show" role="alert">
    Menampilkan hasil pencarian untuk: <strong>"{{ $keyword }}"</strong>
    <a href="{{ route('products.index') }}" class="btn-close" aria-label="Close"></a>
</div>
@endif

@if($products->count() === 0 && isset($keyword) && $keyword)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    ❌ Barang "<strong>{{ $keyword }}</strong>" tidak tersedia
    <a href="{{ route('products.index') }}" class="btn-close" aria-label="Close"></a>
</div>
@endif

<div class="hidden-scroll" style="height: calc(100vh - 250px); overflow-y: auto; padding-right: 15px;">
<table class="table table-bordered product-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Brand</th>
            <th>Judul</th>
            <th>Model</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Diskon (%)</th>
            <th>Harga Setelah Diskon</th>
            <th>Garansi</th>
            <th>Detail</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>

        <td>{{ $product->category->name ?? 'N/A' }}</td>
        <td>
            @if(isset($keyword) && $keyword)
                {!! highlightText($product->brand, $keyword) !!}
            @else
                {{ $product->brand }}
            @endif
        </td>
        <td>
            @if(isset($keyword) && $keyword)
                {!! highlightText($product->judul, $keyword) !!}
            @else
                {{ $product->judul }}
            @endif
        </td>
        <td>
            @if(isset($keyword) && $keyword)
                {!! highlightText($product->model, $keyword) !!}
            @else
                {{ $product->model }}
            @endif
        </td>

        <td>{{ $product->stok }}</td>

        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
        <td>{{ $product->diskon }}%</td>

        <td>Rp {{ number_format($product->harga_akhir, 0, ',', '.') }}</td>

        <td>{{ $product->garansi }}</td>

        <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {{ $product->detail }}
        </td>

        <td>
            @if($product->image)
                <img src="{{ $product->image }}" width="90" style="border-radius:5px; height: 70px; object-fit: cover;" 
                     alt="{{ $product->judul }}" title="{{ $product->judul }}">
            @else
                <span class="text-muted">No Image</span>
            @endif
        </td>

        <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

{!! $products->links() !!}

</div>

@endsection