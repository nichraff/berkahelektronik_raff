<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mt-1 mb-3" style="font-size: 25px;">
    Barang Berkah Elektronik
</h4>
<div style="text-align: right; margin-bottom: 15px;">
  <a class="btn btn-success" href="<?php echo e(route('products.create')); ?>">Tambah Produk</a>
</div>

<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>

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
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e(++$i); ?></td>
        <td><?php echo e($product->category->name ?? 'N/A'); ?></td>
        <td><?php echo e($product->brand); ?></td>
        <td><?php echo e($product->judul); ?></td>
        <td><?php echo e($product->model); ?></td>
        <td><?php echo e($product->stok); ?></td>
        <td>Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></td>
        <td><?php echo e($product->diskon); ?>%</td>
        <td>Rp <?php echo e(number_format($product->harga_akhir, 0, ',', '.')); ?></td>
        <td><?php echo e($product->garansi); ?></td>
        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
            <?php echo e($product->detail); ?>

        </td>
        
        
        <td>
        <?php
            $placeholder = 'https://drive.google.com/uc?export=view&id=15Ubr-kYNPIjph3G5Rnyspc02n6Zw_0LD';
            $imgUrl = $product->image_url ?: $placeholder;
        ?>

        <img src="<?php echo e($imgUrl); ?>" 
            class="product-image"
            style="max-width:100px; max-height:100px; border-radius:5px; border:1px solid #ddd; padding:2px;"
            alt="<?php echo e($product->judul); ?>"
            onerror="this.src='<?php echo e($placeholder); ?>';">
        </td>
        
        <td>
            <form action="<?php echo e(route('products.destroy',$product->id)); ?>" method="POST" style="display: inline-block;">
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('products.edit',$product->id)); ?>">Edit</a>
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk?')">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo $products->links(); ?>

</div>  

<style>
.product-table {
    font-size: 14px;
}
.product-table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
.product-table td {
    vertical-align: middle;
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('products.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/products/index.blade.php ENDPATH**/ ?>