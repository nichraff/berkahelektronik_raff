@include('customers.dashboard.navbar')

<div class="container mt-4">

    <h3 class="mb-4">Laporan Penjualan</h3>

    <div class="row g-4 mb-4">

        <!-- Total Transaksi -->
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-icon text-primary">
                    <i class="bi bi-cart-check"></i>
                </div>
                <h4>{{ $totalTransaksi }}</h4>
                <p>Total Transaksi</p>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-md-4">
            <div class="menu-card">
                <div class="menu-icon text-success">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h4>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
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
            @if($latestTransactions->count() == 0)
                <p>Tidak ada transaksi.</p>
            @else
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
                        @foreach($latestTransactions as $trx)
                        <tr>
                            <td>{{ $trx->invoice }}</td>
                            <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($trx->status) }}</td>
                            <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
