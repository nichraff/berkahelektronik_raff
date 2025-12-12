@extends('products.layout')

@section('content')

<h4 class="fw-bold mb-3">Daftar Produk</h4>
<a href="{{ route('products.create') }}" class="btn btn-success mb-3">Tambah Produk</a>

<table class="table table-bordered product-table hidden-scroll">
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
            <th>Harga Akhir</th>
            <th>Garansi</th>
            <th>Detail</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $i => $product)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
            <td>{{ $product->brand }}</td>
            <td>{{ $product->judul }}</td>
            <td>{{ $product->model }}</td>
            <td>{{ $product->stok }}</td>
            <td>Rp {{ number_format($product->harga,0,',','.') }}</td>
            <td>{{ $product->diskon }}%</td>
            <td>Rp {{ number_format($product->harga_akhir,0,',','.') }}</td>
            <td>{{ $product->garansi }}</td>
            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                {{ $product->detail }}
            </td>
            <td>
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" class="product-image" alt="{{ $product->judul }}">
                @endif
            </td>
            <td>
                <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus produk?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $products->links() !!}

@endsection
