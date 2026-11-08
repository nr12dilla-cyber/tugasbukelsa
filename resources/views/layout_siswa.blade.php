<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JarKomDas - Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background: #f0f7ff; }

        .sw-nav {
            background: linear-gradient(90deg, #2563eb, #7c3aed);
            padding: .7rem 1.25rem;
            display: flex; align-items: center; gap: .5rem; flex-wrap: wrap;
            box-shadow: 0 4px 14px rgba(37, 99, 235, .25);
        }
        .sw-brand {
            color: #fff; font-weight: 700; font-size: 1.1rem;
            margin-right: 1rem; text-decoration: none;
        }
        .sw-link {
            color: rgba(255, 255, 255, .85); text-decoration: none;
            padding: .45rem 1rem; border-radius: 999px;
            font-size: .9rem; font-weight: 500;
            display: inline-flex; align-items: center; gap: .4rem;
            transition: all .2s;
        }
        .sw-link:hover { background: rgba(255, 255, 255, .18); color: #fff; }
        .sw-link.active { background: #fff; color: #2563eb; }
        .sw-keluar {
            border: 0; background: rgba(255, 255, 255, .2); color: #fff;
            padding: .45rem 1rem; border-radius: 999px;
            font-size: .9rem; font-weight: 500;
            display: inline-flex; align-items: center; gap: .4rem;
            transition: background .2s;
        }
        .sw-keluar:hover { background: #ef4444; }
    </style>
</head>
<body>

@auth
<nav class="sw-nav">
    <a class="sw-brand" href="/dashboard">
        <i class="bi bi-mortarboard-fill"></i> JarKomDas
    </a>

    <a class="sw-link {{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }}" href="/dashboard">
        <i class="bi bi-house-door"></i> Beranda
    </a>
    <a class="sw-link {{ request()->is('materi*') || request()->is('kuis*') ? 'active' : '' }}" href="/materi">
        <i class="bi bi-journal-text"></i> Materi
    </a>
    <a class="sw-link {{ request()->is('nilai*') ? 'active' : '' }}" href="/nilai">
        <i class="bi bi-trophy"></i> Nilai Saya
    </a>

    <form method="POST" action="/logout" class="ms-auto mb-0">
        @csrf
        <button class="sw-keluar"><i class="bi bi-box-arrow-right"></i> Keluar</button>
    </form>
</nav>
@endauth

<div class="container py-4">
    @if(session('ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('ok') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tempat konten utama dimuat --}}
    @yield('isi')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>