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

        .hidden-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .hidden-scroll::-webkit-scrollbar {
            display: none;
        }

        .product-table thead {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: #2f55ff !important;
            color: white;
            text-align: center;
            font-weight: 600;
        }

        .product-table th, .product-table td {
            border: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TOKO BERKAH ELEKTRONIK</a>

            <div class="d-flex align-items-center">
                <input type="text" class="form-control form-control-sm me-3" style="width:250px;" placeholder="Cari Elektronik">

                <i class="bi bi-person fs-4"></i>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <span class="ms-2 fw-bold">Admin</span>
                    @else
                        <span class="ms-2 fw-bold">{{ auth()->user()->name }}</span>
                    @endif
                @endauth

                @guest
                    <span class="ms-2 fw-bold">Guest</span>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
