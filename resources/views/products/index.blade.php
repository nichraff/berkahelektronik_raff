@extends('products.layout')
 
@section('content')

<div class="card mt-5">
  <h2>Barang Berkah Elektronik</h2>
<div style="text-align: right; margin-bottom: 15px;">
    <a class="btn btn-success" href="{{ route('products.create') }}">Tambah Produk</a>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th >No</th>
            <th>Kategori</th>
            <th style="text-align: center;">Brand</th>
            <th>Judul</th>
            <th>Model</th>
            <th>Harga</th>
            <th width="100px">Diskon (%)</th>
            <th width="200px">Harga Setelah Diskon</th>
            <th>Garansi</th>
            <th>Detail</th>
            <th>Gambar</th>
            <th width="120px">Action</th> </tr>
    </thead>
    
    <tbody>
    @foreach ($products as $product)
<tr>
    <td>{{ ++$i }}</td>

    <td>{{ $product->category->name ?? 'N/A' }}</td>
    
    <td>{{ $product->brand }}</td>
    
    <td>{{ $product->judul }}</td>
    
    <td>{{ $product->model }}</td>
    
    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
    
    <td>{{ $product->diskon }}%</td>
    
    <td>Rp {{ number_format($product->harga_akhir, 0, ',', '.') }}</td>
    
    <td>{{ $product->garansi }}</td>
    
    <td>{{ $product->detail }}</td>
    
    <td>
        @if($product->image)
            <img src="{{ asset('storage/products/' . $product->image) }}" width="100px">
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