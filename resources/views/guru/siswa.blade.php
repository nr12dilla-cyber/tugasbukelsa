@extends('layout')

@section('isi')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* ---------- Latar belakang + gelembung ---------- */
    body {
        background: linear-gradient(170deg, #0b1a52 0%, #14308a 55%, #1d4ed8 100%) fixed !important;
        min-height: 100vh;
    }
    .jk-bubbles { position: fixed; inset: 0; z-index: -1; overflow: hidden; pointer-events: none; }
    .jk-bubbles span {
        position: absolute; bottom: -140px; border-radius: 50%;
        background: radial-gradient(circle at 30% 28%, rgba(255,255,255,.38), rgba(255,255,255,.07) 55%, rgba(255,255,255,.02) 100%);
        border: 1px solid rgba(255, 255, 255, .22);
        animation: jkFloat linear infinite;
    }
    .jk-bubbles span:nth-child(1)  { left: 4%;  width: 46px;  height: 46px;  animation-duration: 16s; animation-delay: 0s; }
    .jk-bubbles span:nth-child(2)  { left: 12%; width: 90px;  height: 90px;  animation-duration: 24s; animation-delay: 3s; }
    .jk-bubbles span:nth-child(3)  { left: 22%; width: 28px;  height: 28px;  animation-duration: 13s; animation-delay: 6s; }
    .jk-bubbles span:nth-child(4)  { left: 34%; width: 64px;  height: 64px;  animation-duration: 20s; animation-delay: 1s; }
    .jk-bubbles span:nth-child(5)  { left: 47%; width: 36px;  height: 36px;  animation-duration: 15s; animation-delay: 8s; }
    .jk-bubbles span:nth-child(6)  { left: 58%; width: 110px; height: 110px; animation-duration: 28s; animation-delay: 2s; }
    .jk-bubbles span:nth-child(7)  { left: 69%; width: 52px;  height: 52px;  animation-duration: 18s; animation-delay: 5s; }
    .jk-bubbles span:nth-child(8)  { left: 79%; width: 30px;  height: 30px;  animation-duration: 14s; animation-delay: 9s; }
    .jk-bubbles span:nth-child(9)  { left: 88%; width: 78px;  height: 78px;  animation-duration: 22s; animation-delay: 4s; }
    .jk-bubbles span:nth-child(10) { left: 95%; width: 40px;  height: 40px;  animation-duration: 17s; animation-delay: 7s; }
    @keyframes jkFloat {
        0%   { transform: translateY(0) translateX(0); opacity: 0; }
        10%  { opacity: 1; }
        50%  { transform: translateY(-60vh) translateX(18px); }
        100% { transform: translateY(-125vh) translateX(-14px); opacity: 0; }
    }

    /* ---------- Halaman ---------- */
    .jk-siswa {
        --blue: #2563eb;
        --ink: #1e293b;
        --muted: #64748b;
        --line: #e2e8f0;
        font-family: 'Nunito', sans-serif;
        max-width: 980px; margin: 0 auto; padding-bottom: 2rem; position: relative;
    }

    /* Header + siswa kartun */
    .jk-head { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin: .2rem 0 1.2rem; }
    .jk-head h1 { color: #fff; font-size: 1.45rem; font-weight: 800; margin: 0; }
    .jk-head p { color: rgba(255,255,255,.75); font-size: .88rem; margin: .15rem 0 0; }
    .jk-student { width: 112px; flex-shrink: 0; margin-bottom: -6px; }

    /* ---------- Kartu ---------- */
    .jk-card {
        background: #fff; border-radius: 14px; color: var(--ink);
        box-shadow: 0 16px 30px -18px rgba(0, 0, 0, .65); overflow: hidden;
    }
    .jk-card-head {
        display: flex; align-items: center; justify-content: space-between; gap: .5rem;
        padding: .75rem 1.1rem; font-weight: 800; font-size: .92rem;
        border-bottom: 2px dashed var(--line);
    }
    .jk-card-head .ttl { display: flex; align-items: center; gap: .5rem; }
    .jk-card-head .ico {
        width: 28px; height: 28px; border-radius: 8px; display: grid; place-items: center;
        color: #fff; font-size: .95rem;
    }
    .ico.blue { background: #3b82f6; }
    .ico.orange { background: #f97316; }
    .jk-count {
        background: #dbeafe; color: #1d4ed8; font-size: .72rem; font-weight: 800;
        padding: .2rem .65rem; border-radius: 999px;
    }

    /* ---------- Form ---------- */
    .jk-form { padding: 1rem 1.1rem 1.15rem; }
    .jk-field { margin-bottom: .85rem; }
    .jk-field label { display: block; font-size: .8rem; font-weight: 700; margin-bottom: .3rem; color: #334155; }
    .jk-input-wrap { position: relative; }
    .jk-input-wrap > i.lead {
        position: absolute; left: .75rem; top: 50%; transform: translateY(-50%);
        color: #94a3b8; font-size: .95rem; pointer-events: none;
    }
    .jk-input-wrap .form-control {
        font-family: 'Nunito', sans-serif; font-size: .88rem; font-weight: 600;
        border: 1.5px solid var(--line); border-radius: 10px;
        padding: .5rem .8rem .5rem 2.3rem; color: var(--ink);
        transition: border-color .2s, box-shadow .2s;
    }
    .jk-input-wrap .form-control::placeholder { color: #a0aec0; font-weight: 400; }
    .jk-input-wrap .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 4px rgba(37, 99, 235, .12); }
    .jk-eye {
        position: absolute; right: .35rem; top: 50%; transform: translateY(-50%);
        border: 0; background: transparent; color: #94a3b8; width: 32px; height: 32px;
        border-radius: 8px; font-size: 1rem;
    }
    .jk-eye:hover { color: var(--blue); background: #eff6ff; }
    .jk-error { color: #dc2626; font-size: .75rem; margin-top: .25rem; font-weight: 600; }

    .jk-btn {
        width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: .45rem;
        padding: .55rem 1rem; border-radius: 999px; border: 0;
        font-family: 'Nunito', sans-serif; font-size: .9rem; font-weight: 800;
        background: #f59e0b; color: #422006;
        box-shadow: 0 4px 0 #b45309; transition: transform .15s, box-shadow .15s;
        margin-top: .3rem;
    }
    .jk-btn:hover { transform: translateY(2px); box-shadow: 0 2px 0 #b45309; }

    /* ---------- Tabel ---------- */
    .jk-table { width: 100%; border-collapse: collapse; }
    .jk-table th {
        font-size: .7rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase;
        color: var(--muted); background: #f8fafc; padding: .6rem 1.1rem; text-align: left;
    }
    .jk-table td { padding: .6rem 1.1rem; font-size: .88rem; border-top: 1px solid #f1f5f9; vertical-align: middle; }
    .jk-table tbody tr { transition: background .15s; }
    .jk-table tbody tr:hover { background: #f8fbff; }
    .jk-no { color: var(--muted); font-weight: 700; width: 52px; }

    .jk-who { display: flex; align-items: center; gap: .6rem; font-weight: 800; }
    .jk-avatar {
        width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
        display: grid; place-items: center; color: #fff; font-size: .8rem; font-weight: 800;
        background: #3b82f6;
    }
    .jk-avatar.a2 { background: #f97316; }
    .jk-avatar.a3 { background: #22c55e; }
    .jk-avatar.a4 { background: #ec4899; }

    .jk-user { color: #475569; font-weight: 600; }
    .jk-user::before { content: '@'; color: #94a3b8; }
    .jk-role {
        background: #dcfce7; color: #15803d; font-size: .72rem; font-weight: 800;
        padding: .2rem .65rem; border-radius: 999px; display: inline-block;
    }

    .jk-empty { text-align: center; padding: 1.8rem 1rem; color: var(--muted); font-size: .88rem; font-weight: 600; }
    .jk-empty svg { width: 90px; display: block; margin: 0 auto .5rem; }

    @media (max-width: 576px) {
        .jk-student { width: 80px; }
        .jk-table th, .jk-table td { padding: .55rem .7rem; }
        .jk-no { width: 36px; }
    }
</style>

{{-- Gelembung latar --}}
<div class="jk-bubbles" aria-hidden="true">
    <span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span>
</div>

<div class="jk-siswa">

    {{-- ===== Header + siswa kartun ===== --}}
    <div class="jk-head">
        <div>
            <h1>Kelola Siswa</h1>
            <p>Daftarkan akun siswa baru dan lihat siapa saja yang sudah terdaftar.</p>
        </div>

        <svg class="jk-student" viewBox="0 0 150 140" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            {{-- badan --}}
            <path d="M18 140 C18 112 40 104 75 104 C110 104 132 112 132 140 Z" fill="#3b82f6"/>
            <path d="M58 104 L75 122 L92 104 Z" fill="#fff"/>
            {{-- leher + kepala --}}
            <rect x="67" y="90" width="16" height="16" rx="5" fill="#f2c29b"/>
            <circle cx="75" cy="68" r="28" fill="#fcd5b0"/>
            <circle cx="47" cy="70" r="5.5" fill="#fcd5b0"/>
            <circle cx="103" cy="70" r="5.5" fill="#fcd5b0"/>
            {{-- rambut --}}
            <path d="M47 64 C46 42 62 36 75 36 C89 36 104 43 103 64 C98 54 90 50 75 50 C61 50 52 54 47 64 Z" fill="#1f2937"/>
            {{-- topi wisuda --}}
            <path d="M75 14 L122 30 L75 46 L28 30 Z" fill="#1e293b"/>
            <path d="M52 38 V50 C52 56 98 56 98 50 V38 L75 46 Z" fill="#334155"/>
            <path d="M118 31 V50" stroke="#f59e0b" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="118" cy="53" r="4" fill="#f59e0b"/>
            {{-- mata + pipi + senyum --}}
            <circle cx="64" cy="72" r="3" fill="#1e293b"/>
            <circle cx="86" cy="72" r="3" fill="#1e293b"/>
            <circle cx="57" cy="80" r="4" fill="#fb7185" fill-opacity=".45"/>
            <circle cx="93" cy="80" r="4" fill="#fb7185" fill-opacity=".45"/>
            <path d="M66 82 Q75 91 84 82" stroke="#9a3412" stroke-width="2.4" stroke-linecap="round" fill="none"/>
        </svg>
    </div>

    <div class="row g-3">

        {{-- ===== Form Daftarkan Siswa Baru ===== --}}
        <div class="col-md-5 col-lg-4">
            <div class="jk-card">
                <div class="jk-card-head">
                    <span class="ttl"><span class="ico orange"><i class="bi bi-person-plus-fill"></i></span> Daftarkan Siswa Baru</span>
                </div>

                <form method="POST" action="/guru/siswa" class="jk-form" autocomplete="off">
                    @csrf

                    <div class="jk-field">
                        <label for="name">Nama Lengkap Siswa</label>
                        <div class="jk-input-wrap">
                            <i class="bi bi-person lead"></i>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Contoh: Nadila" required>
                        </div>
                        @error('name') <div class="jk-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="jk-field">
                        <label for="username">Username (untuk Login)</label>
                        <div class="jk-input-wrap">
                            <i class="bi bi-at lead"></i>
                            <input id="username" type="text" name="username" value="{{ old('username') }}"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Contoh: nadila123" autocomplete="off" required>
                        </div>
                        @error('username') <div class="jk-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="jk-field">
                        <label for="password">Password / Sandi</label>
                        <div class="jk-input-wrap">
                            <i class="bi bi-lock lead"></i>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 4 karakter" autocomplete="new-password" required>
                            <button type="button" class="jk-eye" id="togglePw" aria-label="Tampilkan password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password') <div class="jk-error">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="jk-btn"><i class="bi bi-plus-circle-fill"></i> Daftarkan Siswa</button>
                </form>
            </div>
        </div>

        {{-- ===== Tabel Daftar Siswa ===== --}}
        <div class="col-md-7 col-lg-8">
            <div class="jk-card">
                <div class="jk-card-head">
                    <span class="ttl"><span class="ico blue"><i class="bi bi-people-fill"></i></span> Daftar Siswa Terdaftar</span>
                    <span class="jk-count">{{ count($siswas) }} siswa</span>
                </div>

                <table class="jk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $i => $s)
                        <tr>
                            <td class="jk-no">{{ $i + 1 }}</td>
                            <td>
                                <div class="jk-who">
                                    <span class="jk-avatar a{{ ($i % 4) + 1 }}">{{ strtoupper(mb_substr($s->name, 0, 1)) }}</span>
                                    {{ $s->name }}
                                </div>
                            </td>
                            <td class="jk-user">{{ $s->username }}</td>
                            <td><span class="jk-role">Siswa</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="jk-empty">
                                    <svg viewBox="0 0 120 96" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <rect x="8" y="66" width="104" height="22" rx="4" fill="#3b82f6"/>
                                        <rect x="14" y="72" width="92" height="4" rx="2" fill="#bfdbfe"/>
                                        <rect x="18" y="44" width="90" height="22" rx="4" fill="#f97316"/>
                                        <rect x="24" y="50" width="78" height="4" rx="2" fill="#fed7aa"/>
                                        <rect x="12" y="22" width="96" height="22" rx="4" fill="#22c55e"/>
                                        <rect x="18" y="28" width="84" height="4" rx="2" fill="#bbf7d0"/>
                                    </svg>
                                    Belum ada siswa yang didaftarkan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    // Tombol mata: tampilkan / sembunyikan password
    (function () {
        var btn = document.getElementById('togglePw');
        var input = document.getElementById('password');
        if (!btn || !input) return;
        btn.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.innerHTML = show ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
        });
    })();
</script>
@endsection