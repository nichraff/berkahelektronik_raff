<?php $__env->startSection('content'); ?>
<div class="container mt-5 text-center">
    <h2>Pembayaran Berhasil!</h2>
    <p>Invoice: <strong><?php echo e($trx->invoice); ?></strong></p>
    <p>Total: <strong>Rp <?php echo e(number_format($trx->total, 0, ',', '.')); ?></strong></p>

    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary mt-3">Kembali Belanja</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/checkout/success.blade.php ENDPATH**/ ?>