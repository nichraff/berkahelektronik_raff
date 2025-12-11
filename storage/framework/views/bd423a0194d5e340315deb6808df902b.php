 <!-- Layout admin -->

<?php $__env->startSection('title', 'Invoice #' . $transaction->id); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Invoice #<?php echo e($transaction->id); ?></h2>

    <div class="card p-4">
        <div class="mb-3">
            <strong>Pelanggan:</strong> <?php echo e($transaction->user->name ?? 'Tidak Diketahui'); ?><br>
            <strong>Email:</strong> <?php echo e($transaction->user->email ?? '-'); ?><br>
            <strong>Tanggal:</strong> <?php echo e($transaction->created_at->format('d M Y H:i')); ?>

        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transaction->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td>Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td><strong>Rp <?php echo e(number_format($transaction->total, 0, ',', '.')); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="text-end mt-3">
            <button class="btn btn-primary" onclick="window.print()">Cetak Invoice</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/admin/invoice/index.blade.php ENDPATH**/ ?>