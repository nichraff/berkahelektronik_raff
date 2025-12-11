<?php $__env->startSection('content'); ?>
<div class="container mt-5 text-center">
    <h2>Pembayaran Dibatalkan</h2>
    <p>Transaksi tidak berhasil.</p>

    <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-warning mt-3">Kembali ke Keranjang</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/checkout/cancel.blade.php ENDPATH**/ ?>