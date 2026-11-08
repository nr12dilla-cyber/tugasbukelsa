@extends('layout')

@section('isi')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Latar belakang halaman: biru gelap (sama dengan halaman Materi) */
    body {
        background:
            radial-gradient(900px 500px at 85% -10%, rgba(59, 130, 246, .35), transparent 60%),
            linear-gradient(165deg, #0a1640 0%, #12246b 55%, #1b3a8f 100%) fixed !important;
        min-height: 100vh;
    }

    /* ---------- Bubble dekorasi ---------- */
    .jk-bubbles {
        position: fixed; inset: 0; overflow: hidden;
        pointer-events: none; z-index: 0;
    }
    .jk-bubbles span {
        position: absolute; bottom: -160px; border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(255,255,255,.35), rgba(255,255,255,.06) 70%);
        border: 1px solid rgba(255,255,255,.18);
        animation: jk-naik linear infinite;
    }
    .jk-bubbles span:nth-child(1) { left: 6%;  width: 60px;  height: 60px;  animation-duration: 16s; animation-delay: 0s; }
    .jk-bubbles span:nth-child(2) { left: 18%; width: 100px; height: 100px; animation-duration: 22s; animation-delay: 3s; }
    .jk-bubbles span:nth-child(3) { left: 32%; width: 40px;  height: 40px;  animation-duration: 14s; animation-delay: 6s; }
    .jk-bubbles span:nth-child(4) { left: 52%; width: 80px;  height: 80px;  animation-duration: 20s; animation-delay: 1s; }
    .jk-bubbles span:nth-child(5) { left: 66%; width: 50px;  height: 50px;  animation-duration: 17s; animation-delay: 8s; }
    .jk-bubbles span:nth-child(6) { left: 78%; width: 120px; height: 120px; animation-duration: 25s; animation-delay: 4s; }
    .jk-bubbles span:nth-child(7) { left: 90%; width: 45px;  height: 45px;  animation-duration: 15s; animation-delay: 10s; }
    .jk-bubbles span:nth-child(8) { left: 44%; width: 26px;  height: 26px;  animation-duration: 12s; animation-delay: 5s; }

    @keyframes jk-naik {
        0%   { transform: translateY(0) translateX(0); opacity: 0; }
        10%  { opacity: 1; }
        50%  { transform: translateY(-60vh) translateX(25px); }
        100% { transform: translateY(-120vh) translateX(-15px); opacity: 0; }
    }

    .jk-form {
        --blue: #2563eb;
        --blue-dark: #1d4ed8;
        --ink: #1e293b;
        --muted: #64748b;
        --line: #e2e8f0;

        font-family: 'Poppins', sans-serif;
        position: relative; z-index: 1;
        max-width: 600px;              /* lebih kecil, tidak terlalu lebar */
        margin: 0 auto;
        padding-bottom: 2rem;
    }

    /* ---------- Header + gambar papan tulis ---------- */
    .jk-head {
        display: flex; align-items: center; justify-content: space-between;
        gap: 1rem; color: #fff; margin: .5rem 0 1.2rem;
    }
    .jk-head h1 { font-size: 1.5rem; font-weight: 700; margin: 0; }
    .jk-head p { margin: .2rem 0 0; font-size: .88rem; color: rgba(255,255,255,.75); }
    .jk-head svg { flex-shrink: 0; width: 110px; height: auto; }

    /* ---------- Kartu form ---------- */
    .jk-box {
        position: relative;
        background: #fff; border-radius: 22px;
        padding: 1.4rem 1.6rem 1.6rem; color: var(--ink);
        box-shadow: 0 24px 48px -24px rgba(0, 0, 0, .6);
    }
    /* pita merah kecil di pojok kartu */
    .jk-box::after {
        content: ""; position: absolute; top: 0; right: 26px;
        width: 24px; height: 42px; background: #ef4444;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 78%, 0 100%);
    }

    /* label kecil "Materi" di atas kartu */
    .jk-pill {
        display: inline-flex; align-items: center; gap: .4rem;
        background: #e0ebff; color: #1d4ed8;
        font-size: .78rem; font-weight: 600;
        padding: .3rem .75rem; border-radius: 999px;
        margin-bottom: 1.1rem;
    }

    .jk-field { margin-bottom: 1.1rem; }
    .jk-field label {
        display: flex; align-items: center; gap: .5rem;
        font-size: .86rem; font-weight: 600; margin-bottom: .4rem;
    }
    .jk-field label small { font-weight: 400; color: var(--muted); font-size: .76rem; margin-left: auto; }

    /* nomor berwarna kecil di label, seperti daftar materi */
    .jk-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 22px; height: 22px; border-radius: 7px;
        color: #fff; font-size: .72rem; font-weight: 700;
    }
    .jk-num.n1 { background: #3b82f6; }
    .jk-num.n2 { background: #f97316; }
    .jk-num.n3 { background: #22c55e; }

    .jk-field .form-control {
        font-family: 'Poppins', sans-serif; font-size: .9rem;
        border: 1.5px solid var(--line); border-radius: 12px;
        padding: .6rem .9rem; color: var(--ink);
        transition: border-color .2s, box-shadow .2s;
    }
    .jk-field .form-control::placeholder { color: #a0aec0; }
    .jk-field .form-control:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
    }
    .jk-field textarea.form-control { resize: vertical; line-height: 1.7; min-height: 150px; }
    .jk-field .is-invalid { border-color: #ef4444; }
    .jk-error { color: #dc2626; font-size: .78rem; margin-top: .3rem; }

    .jk-row { display: grid; grid-template-columns: 1fr 120px; gap: 1rem; }

    /* ---------- Tombol ---------- */
    .jk-actions {
        display: flex; gap: .6rem; flex-wrap: wrap;
        padding-top: 1rem; margin-top: .2rem; border-top: 1px solid var(--line);
    }
    .jk-btn {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .6rem 1.25rem; border-radius: 12px;
        font-family: 'Poppins', sans-serif; font-size: .88rem; font-weight: 500;
        text-decoration: none; cursor: pointer; transition: all .2s ease;
    }
    .jk-btn.solid { background: var(--blue); color: #fff; border: 1px solid var(--blue); box-shadow: 0 8px 16px -10px rgba(37,99,235,.9); }
    .jk-btn.solid:hover { background: var(--blue-dark); border-color: var(--blue-dark); }
    .jk-btn.outline { background: #fff; color: var(--muted); border: 1px solid var(--line); }
    .jk-btn.outline:hover { color: var(--ink); border-color: #cbd5e1; background: #f8fafc; }

    /* ---------- Gambar tumpukan buku di bawah kartu ---------- */
    .jk-books { display: flex; justify-content: center; margin-top: 1.4rem; }
    .jk-books svg { width: 90px; height: auto; }

    @media (max-width: 576px) {
        .jk-head svg { width: 80px; }
        .jk-box { padding: 1.2rem 1.1rem 1.3rem; }
        .jk-row { grid-template-columns: 1fr; gap: 0; }
        .jk-btn { width: 100%; justify-content: center; }
    }

    @media (prefers-reduced-motion: reduce) {
        .jk-bubbles span { animation: none; bottom: 20%; opacity: .5; }
    }
</style>

{{-- Bubble dekorasi --}}
<div class="jk-bubbles" aria-hidden="true">
    <span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span>
</div>

<div class="jk-form">

    <div class="jk-head">
        <div>
            <h1>Tambah Materi</h1>
            <p>Isi judul dan isi materi yang akan dipelajari siswa.</p>
        </div>

        {{-- Gambar papan tulis ABC --}}
        <svg viewBox="0 0 130 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <rect x="6" y="6" width="104" height="70" rx="7" fill="#166534" stroke="#b45309" stroke-width="5"/>
            <text x="58" y="44" text-anchor="middle" font-family="Poppins, sans-serif" font-size="22" font-weight="700" fill="#fff" letter-spacing="4">ABC</text>
            <line x1="26" y1="56" x2="70" y2="56" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".8"/>
            <line x1="26" y1="64" x2="52" y2="64" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".6"/>
            <rect x="14" y="78" width="30" height="6" rx="3" fill="#b45309"/>
            {{-- kepala siswa/guru sederhana --}}
            <circle cx="108" cy="62" r="16" fill="#fcd9b6"/>
            <path d="M92 58 Q96 44 108 44 Q120 44 124 58 Q116 52 108 52 Q100 52 92 58Z" fill="#3b2a20"/>
            <circle cx="102" cy="63" r="4" fill="#fff" stroke="#1e293b" stroke-width="1.5"/>
            <circle cx="114" cy="63" r="4" fill="#fff" stroke="#1e293b" stroke-width="1.5"/>
            <line x1="106" y1="63" x2="110" y2="63" stroke="#1e293b" stroke-width="1.5"/>
            <path d="M103 72 Q108 77 113 72" stroke="#c2410c" stroke-width="2" fill="none" stroke-linecap="round"/>
            <path d="M88 100 Q90 84 108 84 Q126 84 128 100Z" fill="#f59e0b"/>
            <path d="M104 84 L108 96 L112 84Z" fill="#ef4444"/>
        </svg>
    </div>

    <form method="POST" action="/guru/materi" class="jk-box">
        @csrf

        <span class="jk-pill">
            <svg width="13" height="13" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                <path d="M2 2.5A1.5 1.5 0 0 1 3.5 1h9A1.5 1.5 0 0 1 14 2.5v11a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zM4 4v1.5h8V4zm0 3.25v1.5h8v-1.5zM4 10.5V12h5v-1.5z"/>
            </svg>
            Materi Baru
        </span>

        <div class="jk-row">
            <div class="jk-field">
                <label for="judul"><span class="jk-num n1">1</span> Judul Materi</label>
                <input id="judul" name="judul" value="{{ old('judul') }}"
                       class="form-control @error('judul') is-invalid @enderror"
                       placeholder="Contoh: Pengenalan Topologi Jaringan" required>
                @error('judul') <div class="jk-error">{{ $message }}</div> @enderror
            </div>

            <div class="jk-field">
                <label for="urutan"><span class="jk-num n2">2</span> Urutan <small>opsional</small></label>
                <input id="urutan" type="number" name="urutan" value="{{ old('urutan') }}"
                       class="form-control @error('urutan') is-invalid @enderror"
                       placeholder="1" min="1">
                @error('urutan') <div class="jk-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="jk-field">
            <label for="isi"><span class="jk-num n3">3</span> Isi Materi</label>
            <textarea id="isi" name="isi" rows="6"
                      class="form-control @error('isi') is-invalid @enderror"
                      placeholder="Tulis penjelasan materi di sini..." required>{{ old('isi') }}</textarea>
            @error('isi') <div class="jk-error">{{ $message }}</div> @enderror
        </div>

        <div class="jk-actions">
            <button type="submit" class="jk-btn solid">Simpan Materi</button>
            <a href="/materi" class="jk-btn outline">Batal</a>
        </div>
    </form>

    {{-- Gambar tumpukan buku --}}
    <div class="jk-books" aria-hidden="true">
        <svg viewBox="0 0 100 80" xmlns="http://www.w3.org/2000/svg">
            <path d="M52 8 L72 14 L52 20Z" fill="#ec4899"/>
            <line x1="52" y1="8" x2="52" y2="26" stroke="#ec4899" stroke-width="2" stroke-linecap="round"/>
            <rect x="18" y="26" width="64" height="14" rx="4" fill="#22c55e"/>
            <rect x="26" y="31" width="42" height="3" rx="1.5" fill="#fff" opacity=".85"/>
            <rect x="24" y="42" width="58" height="14" rx="4" fill="#f97316"/>
            <rect x="32" y="47" width="38" height="3" rx="1.5" fill="#fff" opacity=".85"/>
            <rect x="12" y="58" width="70" height="14" rx="4" fill="#3b82f6"/>
            <rect x="20" y="63" width="46" height="3" rx="1.5" fill="#fff" opacity=".85"/>
        </svg>
    </div>

</div>
@endsection