<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h3 class="mb-4">Keranjang Belanja</h3>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($cart->count() == 0): ?>
        <div class="alert alert-info">
            Keranjang masih kosong.
        </div>
        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">Belanja Sekarang</a>
    <?php else: ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <strong><?php echo e($item->product->judul); ?></strong> <br>
                    <small><?php echo e($item->product->brand); ?> - <?php echo e($item->product->model); ?></small>
                </td>

                <td>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>

                <td style="width: 140px;">
                    <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="input-group input-group-sm">
                            <input type="number" name="qty" value="<?php echo e($item->qty); ?>" min="1" class="form-control">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </td>

                <td>
                    <strong>Rp <?php echo e(number_format($item->harga_akhir, 0, ',', '.')); ?></strong>
                </td>

                <td>
                    <form action="<?php echo e(route('cart.delete', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus item ini?')">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="text-end">
        <h4>Total Bayar: <strong>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></strong></h4>

        <a href="<?php echo e(route('checkout.start')); ?>" class="btn btn-success btn-lg mt-3">
            Checkout & Bayar
        </a>
    </div>

    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/cart/index.blade.php ENDPATH**/ ?>