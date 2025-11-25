@extends('products.layout')
 
@section('content')

<h4 class="fw-bold mt-1 mb-3" style="font-size: 25px;">
    Barang Berkah Elektronik
</h4>
<div style="text-align: right; margin-bottom: 15px;">
  <a class="btn btn-success" href="{{ route('products.create') }}">Tambah Produk</a>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif

<div class="hidden-scroll" style="height: calc(100vh - 250px); overflow-y: auto; padding-right: 15px;">
<table class="table table-bordered product-table">
    <thead>
        <tr>
            <th >No</th>
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
            <th>Action</th> </tr>
    </thead>
    
    <tbody>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>

        <td>{{ $product->category->name ?? 'N/A' }}</td>
        
        <td>{{ $product->brand }}</td>
        
        <td>{{ $product->judul }}</td>
        
        <td>{{ $product->model }}</td>

        <td>{{ $product->stok }}</td>
        
        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
        
        <td>{{ $product->diskon }}%</td>
        
        <td>Rp {{ number_format($product->harga_akhir, 0, ',', '.') }}</td>
        
        <td>{{ $product->garansi }}</td>
        
        <td>{{ $product->detail }}</td>
        
        <td>
            @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" class="product-image">
            @else
                No Image
            @endif
        </td>
        
        <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>

@endforeach
    </tbody>
</table>

{!! $products->links() !!}

  </div>
</div>  
@endsection