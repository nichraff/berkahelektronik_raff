<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Berkah Elektronik - Dashboard</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- Optional: CSS tambahan untuk dashboard -->
  <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
</head>
<body>

  <!-- INCLUDE NAVBAR -->
  <?php echo $__env->make('customers.dashboard.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- DASHBOARD CONTENT -->
  <div class="dashboard-container d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar bg-white p-3 shadow-sm">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="menu-item active d-flex align-items-center gap-2 mb-2">
        <span class="menu-icon">📊</span> Dashboard
      </a>
      <a href="<?php echo e(route('products.index')); ?>" class="menu-item d-flex align-items-center gap-2 mb-2">
        <span class="menu-icon">📦</span> Barang
      </a>
      <a href="#" class="menu-item d-flex align-items-center gap-2 mb-2">
        <span class="menu-icon">📈</span> Laporan Penjualan
      </a>
      <a href="#" class="menu-item d-flex align-items-center gap-2 mb-2">
        <span class="menu-icon">👤</span> Admin
      </a>
      <a href="#" class="menu-item d-flex align-items-center gap-2 mb-2">
        <span class="menu-icon">🧾</span> Invoice
      </a>

      <!-- LOGOUT SIDEBAR -->
      <a href="#"
         class="menu-item d-flex align-items-center gap-2"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="menu-icon">🚪</span> Logout
      </a>

      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
        <?php echo csrf_field(); ?>
      </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content flex-fill p-3">
      <div class="card mb-3">
        <div class="card-body">
          <h1 class="display-6 fw-bold">Hi, <?php echo e(auth()->user()->name); ?></h1>
          <p class="lead">
            Selamat datang di dashboard Toko Berkah Elektronik.<br>
            Kelola toko Anda dengan mudah dari sini.
          </p>
        </div>
      </div>

      <div class="row">
        <!-- TRANSAKSI -->
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <span>Transaksi Terbaru</span>
              <a href="#" class="view-all text-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
              <div class="transaction-item d-flex justify-content-between align-items-center p-3 border-bottom">
                <div class="transaction-info">
                  <div class="fw-bold">TOKO-BERKAH-ELEKTRONIK 1544...</div>
                  <div class="transaction-date text-muted small">2025-10-02</div>
                </div>
                <div class="transaction-amount fw-bold text-success">+Rp 1.250.000</div>
              </div>
              <div class="transaction-item d-flex justify-content-between align-items-center p-3">
                <div class="transaction-info">
                  <div class="fw-bold">TOKO-BERKAH-ELEKTRONIK 1544...</div>
                  <div class="transaction-date text-muted small">2025-10-01</div>
                </div>
                <div class="transaction-amount fw-bold text-success">+Rp 980.000</div>
              </div>
            </div>
          </div>
        </div>

        <!-- STATISTIK -->
        <div class="col-md-4">
          <div class="card mb-3">
            <div class="card-body text-center">
              <div class="stats-number display-5 fw-bold text-primary">15</div>
              <div class="stats-label text-muted">Produk Terjual Hari Ini</div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body text-center">
              <div class="stats-number display-5 fw-bold text-primary">Rp 8.5jt</div>
              <div class="stats-label text-muted">Pendapatan Bulan Ini</div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-body text-center">
              <div class="stats-number display-5 fw-bold text-primary">124</div>
              <div class="stats-label text-muted">Total Pelanggan</div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- END MAIN CONTENT -->

  </div> <!-- END DASHBOARD CONTAINER -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/dashboard.blade.php ENDPATH**/ ?>