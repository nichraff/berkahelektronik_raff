<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Berkah Elektronik - Dashboard Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    .navbar-brand {
      font-weight: 800;
      color: #2948ff !important;
      text-transform: uppercase;
      line-height: 1.1;
      text-decoration: none;
      cursor: pointer;
    }

    .navbar-brand:hover {
      color: #1934d4 !important;
    }

    /* Navbar Styles */
    .navbar-container {
      display: flex;
      align-items: center;
      width: 100%;
      justify-content: space-between;
    }

    .navbar-left-section {
      display: flex;
      align-items: center;
      gap: 40px;
    }

    .category-text {
      font-weight: bold;
      color: #000;
      font-size: 16px;
    }

    .navbar-center-section {
      display: flex;
      justify-content: center;
      flex: 1;
      margin: 0 40px;
    }

    .search-box {
      width: 100%;
      max-width: 600px;
    }

    .navbar-right-section {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    /* Dashboard Styles */
    .dashboard-container {
      display: flex;
      min-height: calc(100vh - 76px);
    }

    .sidebar {
      width: 250px;
      background: white;
      padding: 20px;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .main-content {
      flex: 1;
      padding: 20px;
      background: #f8f9fa;
    }

    .menu-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 15px;
      margin-bottom: 5px;
      border-radius: 8px;
      text-decoration: none;
      color: #333;
      transition: all 0.3s;
    }

    .menu-item:hover {
      background: #2948ff;
      color: white;
    }

    .menu-item.active {
      background: #2948ff;
      color: white;
    }

    .menu-icon {
      width: 20px;
      text-align: center;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .card-header {
      background: white;
      border-bottom: 1px solid #eee;
      font-weight: 600;
      padding: 15px 20px;
    }

    .transaction-item {
      display: flex;
      justify-content: between;
      align-items: center;
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
    }

    .transaction-item:last-child {
      border-bottom: none;
    }

    .transaction-info {
      flex: 1;
    }

    .transaction-amount {
      font-weight: 600;
      color: #28a745;
    }

    .transaction-date {
      color: #6c757d;
      font-size: 12px;
    }

    .stats-card {
      text-align: center;
      padding: 20px;
    }

    .stats-number {
      font-size: 2rem;
      font-weight: 700;
      color: #2948ff;
    }

    .stats-label {
      color: #6c757d;
      font-size: 14px;
    }

    .view-all {
      color: #2948ff;
      text-decoration: none;
      font-weight: 600;
    }

    .view-all:hover {
      text-decoration: underline;
    }

    @media (max-width: 992px) {
      .dashboard-container {
        flex-direction: column;
      }
      
      .sidebar {
        width: 100%;
      }

      .navbar-container {
        flex-direction: column;
        gap: 15px;
      }

      .navbar-left-section {
        width: 100%;
        justify-content: space-between;
      }

      .navbar-center-section {
        width: 100%;
        order: 3;
        margin: 0;
      }

      .navbar-right-section {
        width: 100%;
        justify-content: center;
      }

      .search-box {
        width: 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR dengan search bar memanjang -->
  <nav class="navbar navbar-light bg-white border-bottom shadow-sm px-3">
    <div class="container-fluid">
      <div class="navbar-container">
        <!-- Bagian kiri: Logo + Kategori -->
        <div class="navbar-left-section">
          <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            TOKO BERKAH<br>ELEKTRONIK
          </a>
          <span class="category-text">Kategori</span>
        </div>

        <!-- Bagian tengah: Search bar memanjang -->
        <div class="navbar-center-section">
          <input type="text" class="form-control form-control-sm search-box" placeholder="Cari Elektronik">
        </div>

        <!-- Bagian kanan: Icons -->
        <div class="navbar-right-section">
          <i class="bi bi-cart3" style="font-size: 1.2rem;"></i>
          <i class="bi bi-person" style="font-size: 1.2rem;"></i>
        </div>
      </div>
    </div>
  </nav>

  <!-- DASHBOARD CONTENT -->
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <a href="#" class="menu-item active">
        <div class="menu-icon">📊</div>
        <span>Dashboard</span>
      </a>
      <a href="#" class="menu-item">
        <div class="menu-icon">📦</div>
        <span>Barang</span>
      </a>
      <a href="#" class="menu-item">
        <div class="menu-icon">📈</div>
        <span>Laporan Penjualan</span>
      </a>
      <a href="#" class="menu-item">
        <div class="menu-icon">👤</div>
        <span>Admin</span>
      </a>
      <a href="#" class="menu-item">
        <div class="menu-icon">🧾</div>
        <span>Invoice</span>
      </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Welcome Section -->
      <div class="card">
        <div class="card-body">
          <h1 class="display-6 fw-bold">Hi, {{ auth()->user()->name }}</h1>
          <p class="lead">
            Selamat datang di dashboard Toko Berkah Elektronik.<br>
            Kelola toko Anda dengan mudah dari sini.
          </p>
        </div>
      </div>

      <div class="row">
        <!-- Recent Transactions -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <span>Transaksi Terbaru</span>
              <a href="#" class="view-all">View All</a>
            </div>
            <div class="card-body p-0">
              <div class="transaction-item">
                <div class="transaction-info">
                  <div class="fw-bold">TOKO-BERKAH-ELEKTRONIK 1544...</div>
                  <div class="transaction-date">2025-10-02</div>
                </div>
                <div class="transaction-amount">+Rp 1.250.000</div>
              </div>
              <div class="transaction-item">
                <div class="transaction-info">
                  <div class="fw-bold">TOKO-BERKAH-ELEKTRONIK 1544...</div>
                  <div class="transaction-date">2025-10-01</div>
                </div>
                <div class="transaction-amount">+Rp 980.000</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body stats-card">
              <div class="stats-number">15</div>
              <div class="stats-label">Produk Terjual Hari Ini</div>
            </div>
          </div>
          <div class="card">
            <div class="card-body stats-card">
              <div class="stats-number">Rp 8.5jt</div>
              <div class="stats-label">Pendapatan Bulan Ini</div>
            </div>
          </div>
          <div class="card">
            <div class="card-body stats-card">
              <div class="stats-number">124</div>
              <div class="stats-label">Total Pelanggan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>