<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Toko Berkah Elektronik</title>

    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .table {
            border: none !important;       
            width: auto;                   
            table-layout: auto;
            margin: 0 auto;                
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
            padding: 8px;
        }

        
        .table td:nth-child(4),
        .table th:nth-child(4) {
        white-space: nowrap;
        min-width: 150px;
        }

        .table td:nth-child(6),
        .table th:nth-child(6) {
        white-space: nowrap;
        min-width: 130px;
        }

        .table td:nth-child(10),
        .table th:nth-child(10) {
        min-width: 250px;
        white-space: normal;
        text-align: left;
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
    </style>
</head>

<body>
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
