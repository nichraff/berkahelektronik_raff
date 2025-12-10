<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toko Berkah Elektronik</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* CSS UNTUK HIDDEN SCROLLING  */
        .hidden-scroll {
            -ms-overflow-style: none; 
            scrollbar-width: none;  
        }
        
        .hidden-scroll::-webkit-scrollbar {
            display: none;
        }
        
        /* CSS UNTUK FIXED HEADER TABEL */
        .product-table thead {
            position: sticky;
            top: 0;
            z-index: 10; 
        }

        body {
            background-color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 70px;
        }

        .navbar-brand {
            font-weight: 800;
            color: #2948ff !important;
            text-transform: uppercase;
            line-height: 1.1;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .product-table thead th {
            background-color: #2f55ff !important;   
            color: white !important;                
            text-align: center;
            font-weight: 600;
        }

        /* --- CUSTOM WIDTH UNTUK SETIAP KOLOM --- */
        table.product-table th:nth-child(1) { width: 40px; }    /* No */
        table.product-table th:nth-child(2) { width: 90px; }    /* Kategori */
        table.product-table th:nth-child(3) { width: 90px; }    /* Brand */
        table.product-table th:nth-child(4) { width: 110px; }   /* Judul */
        table.product-table th:nth-child(5) { width: 80px; }    /* Model */
        table.product-table th:nth-child(6) { width: 60px; }    /* Stok */
        table.product-table th:nth-child(7) { width: 110px; }   /* Harga */
        table.product-table th:nth-child(8) { width: 100px; }   /* Diskon */
        table.product-table th:nth-child(9) { width: 130px; }   /* Harga Setelah Diskon */
        table.product-table th:nth-child(10) { width: 90px; }   /* Garansi */
        table.product-table th:nth-child(11) { width: 140px; }  /* Detail */
        table.product-table th:nth-child(12) { width: 130px; }  /* Gambar */
        table.product-table th:nth-child(13) { width: 110px; }  /* Action */

        img.product-image {
            width: 90px;
            border-radius: 5px;
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
        }
        
        .table thead th {
            border-top: none;
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .card {
            border: none;
            box-shadow: none;
        }

        .btn {
            border-radius: 6px;
        }

        .highlight {
            background-color: #fef3c7; /* Kuning muda */
            color: #92400e; /* Coklat tua */
            padding: 2px 4px;
            border-radius: 4px;
            font-weight: bold;
            border: 1px solid #f59e0b;
                }
    </style>
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0; width: 100%; z-index: 1030;">
        <div class="container-fluid">

            <a class="navbar-brand" href="<?php echo e(route('products.index')); ?>">
                TOKO BERKAH<br>ELEKTRONIK
            </a>

            <div class="d-flex align-items-center">

                <!-- Search Form -->
                <form action="<?php echo e(route('products.search')); ?>" method="GET" class="d-flex">
                    <input type="text" 
                           class="form-control form-control-sm me-2" 
                           style="width: 250px;" 
                           placeholder="Cari Elektronik"
                           name="keyword"
                           value="<?php echo e(request('keyword')); ?>"
                           required>
                    <button type="submit" class="btn btn-primary btn-sm d-none">Cari</button>
                </form>

                <!-- ICON USER -->
                <i class="bi bi-person fs-4"></i>

                <!-- ROLE / AUTH TEXT -->
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <span class="ms-2 fw-bold">Admin</span>
                    <?php else: ?>
                        <span class="ms-2 fw-bold"><?php echo e(auth()->user()->name); ?></span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(auth()->guard()->guest()): ?>
                    <span class="ms-2 fw-bold">Guest</span>
                <?php endif; ?>

            </div>
        </div>
    </nav>
    <!-- ================= END NAVBAR =============== -->

    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="keyword"]');
            
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        // Cari form parent dan submit
                        const form = this.closest('form');
                        if (form) {
                            form.submit();
                        }
                    }
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\TokoBerkahElektronik\berkahelektronik_raff\resources\views/products/layout.blade.php ENDPATH**/ ?>