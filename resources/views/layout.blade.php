<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JarKomDas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ---------- Navbar ---------- */
        .jk-nav {
            font-family: 'Poppins', sans-serif;
            background: rgba(10, 22, 64, .92);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            padding: .6rem 1rem;
            display: flex; align-items: center; gap: .75rem;
        }
        .jk-burger {
            width: 40px; height: 40px; border-radius: 10px;
            display: grid; place-items: center;
            font-size: 1.5rem; color: #fff;
            background: transparent; border: 1px solid rgba(255, 255, 255, .25);
            transition: background .2s;
        }
        .jk-burger:hover { background: rgba(255, 255, 255, .1); }

        .jk-nav .nav-link {
            color: rgba(255, 255, 255, .75);
            font-size: .92rem; font-weight: 500;
            padding: .5rem .9rem;
            border-radius: 10px;
            display: inline-flex; align-items: center; gap: .45rem;
            transition: background .2s, color .2s;
        }
        .jk-nav .nav-link:hover { color: #fff; background: rgba(255, 255, 255, .08); }
        .jk-nav .nav-link.active { color: #fff; background: rgba(59, 130, 246, .35); }

        .btn-keluar {
            font-family: 'Poppins', sans-serif;
            font-size: .85rem; font-weight: 500;
            color: #fff; border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 10px; padding: .4rem .9rem;
            display: inline-flex; align-items: center; gap: .4rem;
            background: transparent; transition: all .2s;
        }
        .btn-keluar:hover { background: #ef4444; border-color: #ef4444; color: #fff; }

        /* ---------- Menu samping (burger) ---------- */
        .jk-side {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #0a1640, #12246b);
            color: #fff; width: 280px !important;
        }
        .jk-side .offcanvas-header { border-bottom: 1px solid rgba(255, 255, 255, .1); }
        .jk-side .offcanvas-title { font-weight: 600; font-size: 1rem; }
        .jk-side .side-link {
            display: flex; align-items: center; gap: .75rem;
            color: rgba(255, 255, 255, .8); text-decoration: none;
            padding: .75rem 1rem; border-radius: 12px; margin-bottom: .35rem;
            font-size: .92rem; font-weight: 500;
            transition: background .2s, color .2s, transform .2s;
        }
        .jk-side .side-link i { font-size: 1.15rem; }
        .jk-side .side-link:hover { background: rgba(255, 255, 255, .1); color: #fff; transform: translateX(4px); }
        .jk-side .side-link.active { background: rgba(59, 130, 246, .4); color: #fff; }
    </style>
</head>
<body class="bg-light">

@auth
<nav class="jk-nav">

    {{-- Tombol burger (hanya guru, karena menu tambahan khusus guru) --}}
    @if(auth()->user()->role == 'guru')
        <button class="jk-burger" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSamping" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>
    @endif

    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
        <i class="bi bi-house-door"></i> Beranda
    </a>

    <form method="POST" action="/logout" class="mb-0 ms-auto">
        @csrf
        <button class="btn-keluar"><i class="bi bi-box-arrow-right"></i> Keluar</button>
    </form>
</nav>

{{-- Menu Khusus Guru: muncul saat burger ditekan --}}
@if(auth()->user()->role == 'guru')
<div class="offcanvas offcanvas-start jk-side" tabindex="-1" id="menuSamping" aria-labelledby="menuSampingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuSampingLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
    </div>
    <div class="offcanvas-body">
        <a class="side-link {{ request()->is('materi*') ? 'active' : '' }}" href="/materi">
            <i class="bi bi-journal-text"></i> Materi
        </a>
        <a class="side-link {{ request()->is('guru/siswa*') ? 'active' : '' }}" href="/guru/siswa">
            <i class="bi bi-people"></i> Kelola Siswa
        </a>
        <a class="side-link {{ request()->is('guru/laporan*') ? 'active' : '' }}" href="/guru/laporan">
            <i class="bi bi-clipboard2-data"></i> Laporan
        </a>
        <a class="side-link {{ request()->is('guru/materi/create') ? 'active' : '' }}" href="/guru/materi/create">
            <i class="bi bi-plus-circle"></i> Tambah Materi
        </a>
    </div>
</div>
@endif
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