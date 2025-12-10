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

  <div id="toolbar">
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newProduct()">Add</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProduct()">Edit</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyProduct()">Delete</a>
  </div>

  <table id="dg" title="Product List" class="easyui-datagrid" style="width:100%;height:400px"
    url="{{ route('products.index') }}"  
    method="get"
    toolbar="#toolbar" pagination="true"
    rownumbers="true" fitColumns="true" singleSelect="true">
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

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

<script type="text/javascript">
var url;

function newProduct() {
  $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'New Product');
  $('#fm').form('clear');
  url = "{{ route('products.store') }}";
}

function editProduct() {
  var row = $('#dg').datagrid('getSelected');
  if (row) {
    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit Product');
    $('#fm').form('load', row);
    url = "/products/" + row.id; 
  } else {
    $.messager.alert('Warning', 'Please select a product first!');
  }
}

function saveProduct() {
  var row = $('#dg').datagrid('getSelected');
  var formData = $('#fm').serializeArray(); 
  var method = url.includes('/products/') ? 'PUT' : 'POST';

  var data = {};
  $.map(formData, function(n, i){
    data[n['name']] = n['value'];
  });

  $.ajax({
    url: url,
    type: method,   
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
    data: data,
    success: function (result) {
      $('#dlg').dialog('close'); 
      $('#dg').datagrid('reload'); 
      $.messager.show({ title: 'Success', msg: result.message || 'Product saved successfully!' });
    },
    error: function (xhr) {
      let msg = xhr.responseJSON?.message || 'Failed to save product.';
      $.messager.alert('Error', msg);
    }
  });
}

function destroyProduct() {
  var row = $('#dg').datagrid('getSelected');
  if (row) {
    $.messager.confirm('Confirm', 'Are you sure you want to delete this product?', function (r) {
      if (r) {
        $.ajax({
          url: "/products/" + row.id,
          type: 'DELETE',   
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          success: function (result) {
            $('#dg').datagrid('reload');
            $.messager.show({ title: 'Success', msg: result.message || 'Product deleted successfully!' });
          },
          error: function () {
            $.messager.alert('Error', 'Failed to delete product.');
          }
        });
      }
    });
  } else {
    $.messager.alert('Warning', 'Please select a product first!');
  }
}
</script>
@endpush