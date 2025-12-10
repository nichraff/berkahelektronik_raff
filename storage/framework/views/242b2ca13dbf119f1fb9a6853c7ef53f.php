<?php $__env->startSection('content'); ?>

<h4 class="fw-bold mt-1 mb-3" style="font-size: 25px;">
    Barang Berkah Elektronik
</h4>

<div style="text-align: right; margin-bottom: 15px;">
  <a class="btn btn-success" href="<?php echo e(route('products.create')); ?>" style="border-radius: 8px;">
      <i class="fas fa-plus"></i> Tambah Produk
  </a>
</div>

<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?php echo e($message); ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(isset($keyword) && $keyword): ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    Menampilkan hasil pencarian untuk: <strong>"<?php echo e($keyword); ?>"</strong>
    <a href="<?php echo e(route('products.index')); ?>" class="btn-close" aria-label="Close"></a>
</div>
<?php endif; ?>

<?php if($products->count() === 0 && isset($keyword) && $keyword): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    ❌ Barang "<strong><?php echo e($keyword); ?></strong>" tidak tersedia
    <a href="<?php echo e(route('products.index')); ?>" class="btn-close" aria-label="Close"></a>
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
        <td>
            <?php if(isset($keyword) && $keyword): ?>
                <?php echo highlightText($product->brand, $keyword); ?>

            <?php else: ?>
                <?php echo e($product->brand); ?>

            <?php endif; ?>
        </td>
        <td>
            <?php if(isset($keyword) && $keyword): ?>
                <?php echo highlightText($product->judul, $keyword); ?>

            <?php else: ?>
                <?php echo e($product->judul); ?>

            <?php endif; ?>
        </td>
        <td>
            <?php if(isset($keyword) && $keyword): ?>
                <?php echo highlightText($product->model, $keyword); ?>

            <?php else: ?>
                <?php echo e($product->model); ?>

            <?php endif; ?>
        </td>

        <td><?php echo e($product->stok); ?></td>

        <td>Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></td>
        <td><?php echo e($product->diskon); ?>%</td>

        <td>Rp <?php echo e(number_format($product->harga_akhir, 0, ',', '.')); ?></td>

        <td><?php echo e($product->garansi); ?></td>

        <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <?php echo e($product->detail); ?>

        </td>

        <td>
            <?php if($product->image): ?>
                <img src="<?php echo e($product->image); ?>" width="90" style="border-radius:5px; height: 70px; object-fit: cover;" 
                     alt="<?php echo e($product->judul); ?>" title="<?php echo e($product->judul); ?>">
            <?php else: ?>
                <span class="text-muted">No Image</span>
            <?php endif; ?>
        </td>

        <td>
            <form action="<?php echo e(route('products.destroy',$product->id)); ?>" method="POST">
                <a class="btn btn-primary btn-sm" href="<?php echo e(route('products.edit',$product->id)); ?>">Edit</a>
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php echo $products->links(); ?>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('products.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/products/index.blade.php ENDPATH**/ ?>