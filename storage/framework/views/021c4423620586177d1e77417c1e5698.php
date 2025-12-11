<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Berkah Elektronik</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3a0ca3;
      --success-color: #28a745;
      --warning-color: #ffc107;
    }

    body {
      background-color: #f5f7fb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-container {
      padding: 40px 20px;
      margin-top: 30px;
    }

    .content-box {
      max-width: 1100px;
      margin: 0 auto;
    }

    /* MENU & SUMMARY CARD */
    .menu-card {
      background: white;
      padding: 35px 20px;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      text-align: center;
      cursor: pointer;
      transition: .3s;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .menu-icon {
      font-size: 48px;
      margin-bottom: 15px;
    }

    .menu-card h4 {
      font-size: 28px;
      margin-bottom: 5px;
      font-weight: 700;
    }

    .menu-card p {
      color: #666;
      font-size: 15px;
      margin: 0;
    }
  </style>
</head>
<body>

  <?php echo $__env->make('customers.dashboard.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="main-container">
    <div class="content-box">

      <!-- MENU GRID -->
      <div class="row g-4 mb-4">

        <!-- Barang -->
        <div class="col-md-4">
          <div class="menu-card" onclick="window.location.href='<?php echo e(route('products.index')); ?>'">
            <div class="menu-icon text-primary">
              <i class="bi bi-box"></i>
            </div>
            <h4>Barang</h4>
          </div>
        </div>

        <!-- Laporan Penjualan -->
        <div class="col-md-4">
          <div class="menu-card" onclick="window.location.href='<?php echo e(route('admin.report.index')); ?>'">
            <div class="menu-icon text-success">
              <i class="bi bi-bar-chart"></i>
            </div>
            <h4>Laporan Penjualan</h4>
          </div>
        </div>

        <!-- Invoice -->
        <div class="col-md-4">
          <div class="menu-card" onclick="window.location.href='<?php echo e(route('admin.invoice.index', ['transaction' => 1])); ?>'">
            <div class="menu-icon text-warning">
              <i class="bi bi-receipt"></i>
            </div>
            <h4>Invoice</h4>
          </div>
        </div>

      </div>

      <!-- SUMMARY CARDS -->
      <div class="row g-4 mt-4">

        <!-- Produk Terjual -->
        <div class="col-md-4">
          <div class="menu-card">
            <div class="menu-icon text-primary">
              <i class="bi bi-cart-check"></i>
            </div>
            <h4>15</h4>
            <p>Produk Terjual Hari Ini</p>
          </div>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div class="col-md-4">
          <div class="menu-card">
            <div class="menu-icon text-success">
              <i class="bi bi-currency-dollar"></i>
            </div>
            <h4>Rp 8.5jt</h4>
            <p>Pendapatan Bulan Ini</p>
          </div>
        </div>

        <!-- Total Pelanggan -->
        <div class="col-md-4">
          <div class="menu-card">
            <div class="menu-icon text-warning">
              <i class="bi bi-people"></i>
            </div>
            <h4>124</h4>
            <p>Total Pelanggan</p>
          </div>
        </div>

      </div>

    </div>
  </div>

</body>
</html>
<?php /**PATH D:\TUGAS SCU\Github\berkahelektronik_raff\resources\views/dashboard.blade.php ENDPATH**/ ?>