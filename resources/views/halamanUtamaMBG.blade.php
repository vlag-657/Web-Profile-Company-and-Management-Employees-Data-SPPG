<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program MBG - Makan Bergizi Gratis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <img src="{{ asset('images/BGN_LOGO.png') }}" alt="LOGO BGN" height="50">
        </a>
        <div class="ms-auto">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">Login Admin</a>
            @endauth
        </div>
    </div>
</nav>

<!-- konten -->
<div class="container mt-5">
    <div class="text-center">
        <h1>Selamat Datang di Program Makan Bergizi Gratis (MBG)</h1>
        <p class="lead">Halaman profil company ini akan diisi Hapis dan Adis.</p>
        <img src="https://via.placeholder.com/800x400?text=MBG+Banner" class="img-fluid rounded" alt="MBG">
        <p class="mt-4">Deskripsi tentang program MBG bisa diletakkan di sini.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>