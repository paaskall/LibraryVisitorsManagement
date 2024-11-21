<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding: 15px;
            width: 250px;
            overflow-y: auto; /* Tambahkan scroll jika konten panjang */
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	    margin-top: 30px;
	}
        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%; /* Full-width untuk perangkat kecil */
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0; /* Hapus margin untuk konten */
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center py-3">Visitor Dashboard</h4>
        <a href="{{ route('visitors.index') }}"><i class="fas fa-users"></i> Pengunjung</a>
        <a href="{{ route('visitors.create') }}"><i class="fas fa-user-plus"></i> Tambah Pengunjung</a>
        <a href="{{ route('visitors.statistics') }}"><i class="fas fa-chart-bar"></i> Statistik</a>
        <a href="#"><i class="fas fa-cog"></i> Pengaturan</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <!-- Dynamic Content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
