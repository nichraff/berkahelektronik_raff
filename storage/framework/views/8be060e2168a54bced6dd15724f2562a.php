

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h2 class="mb-4">Detail Transaksi #<?php echo e($transaction->id); ?></h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Tanggal:</strong> <?php echo e($transaction->created_at->format('d M Y H:i')); ?></p>
            <p><strong>Total:</strong> Rp <?php echo e(number_format($transaction->total, 0, ',', '.')); ?></p>
            <p><strong>Status:</strong> <?php echo e($transaction->status ?? 'Belum dibayar'); ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Daftar Produk</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $transaction->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->product->judul ?? 'Produk dihapus'); ?></td>
                            <td><?php echo e($item->qty); ?></td>
                            <td>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></td>
                            <td>Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <a href="<?php echo e(route('checkout.start')); ?>" class="btn btn-secondary mt-3">Kembali ke Riwayat Transaksi</a>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/transactions/show.blade.php ENDPATH**/ ?>