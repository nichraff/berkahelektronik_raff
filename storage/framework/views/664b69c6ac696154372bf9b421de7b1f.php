<?php echo $__env->make('customers.dashboard.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container mt-4">

    <h3 class="mb-4">Laporan Penjualan</h3>

    <div class="row g-4 mb-4">

        <!-- Total Transaksi -->
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-icon text-primary">
                    <i class="bi bi-cart-check"></i>
                </div>
                <h4><?php echo e($totalTransaksi); ?></h4>
                <p>Total Transaksi</p>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-icon text-success">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h4>Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></h4>
                <p>Total Pendapatan</p>
            </div>
        </div>

    </div>

    <!-- Daftar Transaksi Terbaru -->
    <div class="card mt-4">
        <div class="card-header">
            5 Transaksi Terbaru
        </div>
        <div class="card-body">
            <?php if($latestTransactions->count() == 0): ?>
                <p>Tidak ada transaksi.</p>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $latestTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($trx->invoice); ?></td>
                            <td>Rp <?php echo e(number_format($trx->total, 0, ',', '.')); ?></td>
                            <td><?php echo e(ucfirst($trx->status)); ?></td>
                            <td><?php echo e($trx->created_at->format('d M Y H:i')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/admin/report/index.blade.php ENDPATH**/ ?>