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
    .jk-materi {
        --blue: #2563eb;
        --ink: #1e293b;
        --muted: #64748b;
        font-family: 'Nunito', sans-serif;
        max-width: 980px; margin: 0 auto; padding-bottom: 2rem;
        position: relative;
    }

    /* Header + guru kartun */
    .jk-head { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin: .2rem 0 1.2rem; }
    .jk-head h1 { color: #fff; font-size: 1.45rem; font-weight: 800; margin: 0; }
    .jk-head p { color: rgba(255,255,255,.75); font-size: .88rem; margin: .15rem 0 0; }
    .jk-teacher { width: 120px; flex-shrink: 0; margin-bottom: -6px; }

    /* ---------- Daftar materi ---------- */
    .jk-list-title { color: rgba(255,255,255,.7); font-size: .72rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; margin-bottom: .6rem; }
    .jk-item {
        display: flex; align-items: center; gap: .6rem;
        background: #fff; color: var(--ink); text-decoration: none;
        padding: .5rem .7rem .5rem .5rem; border-radius: 12px; margin-bottom: .45rem;
        font-size: .86rem; font-weight: 700; line-height: 1.3;
        box-shadow: 0 6px 14px -8px rgba(0, 0, 0, .55);
        border-left: 4px solid transparent;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .jk-item:hover { transform: translateY(-2px) rotate(-.6deg); color: var(--ink); box-shadow: 0 12px 20px -10px rgba(0,0,0,.6); }
    .jk-item .no {
        width: 26px; height: 26px; border-radius: 8px; flex-shrink: 0;
        display: grid; place-items: center; color: #fff; font-size: .78rem; font-weight: 800;
        background: #3b82f6;
    }
    .jk-item:nth-of-type(4n+2) .no { background: #f97316; }
    .jk-item:nth-of-type(4n+3) .no { background: #22c55e; }
    .jk-item:nth-of-type(4n+4) .no { background: #ec4899; }
    .jk-item.active { background: #fef3c7; border-left-color: #f59e0b; }

    .jk-books { width: 110px; display: block; margin: .9rem auto 0; opacity: .95; }

    /* ---------- Isi materi ---------- */
    .jk-reader {
        background: #fff; border-radius: 14px; color: var(--ink);
        padding: 1.2rem 1.4rem 1.3rem; position: relative;
        box-shadow: 0 16px 30px -18px rgba(0, 0, 0, .65);
    }
    .jk-reader::before { /* pita penanda buku */
        content: ''; position: absolute; top: 0; right: 22px; width: 18px; height: 34px;
        background: #ef4444; clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 78%, 0 100%);
    }
    .jk-badge {
        display: inline-flex; align-items: center; gap: .35rem;
        background: #dbeafe; color: #1d4ed8; font-size: .7rem; font-weight: 800;
        padding: .2rem .6rem; border-radius: 999px; margin-bottom: .55rem;
    }
    .jk-reader h2 { font-size: 1.25rem; font-weight: 800; margin: 0 0 .7rem; padding-right: 36px; line-height: 1.3; }
    .jk-content { font-size: .9rem; line-height: 1.8; color: #475569; }
    .jk-divider { border: 0; border-top: 2px dashed #e2e8f0; margin: 1.1rem 0 .9rem; }

    .jk-btn {
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .45rem 1rem; border-radius: 999px;
        font-size: .85rem; font-weight: 800; text-decoration: none;
        background: #f59e0b; color: #422006;
        box-shadow: 0 4px 0 #b45309; transition: transform .15s, box-shadow .15s;
    }
    .jk-btn:hover { color: #422006; transform: translateY(2px); box-shadow: 0 2px 0 #b45309; }

    /* ---------- Kosong ---------- */
    .jk-empty {
        background: rgba(255, 255, 255, .1); border: 2px dashed rgba(255, 255, 255, .35);
        border-radius: 14px; color: #fff; padding: 1.6rem 1rem; text-align: center;
        font-size: .88rem; font-weight: 600;
    }
    .jk-empty svg { width: 110px; display: block; margin: 0 auto .6rem; }

    @media (max-width: 576px) {
        .jk-teacher { width: 84px; }
        .jk-reader { padding: 1.1rem 1rem; }
    }
</style>

{{-- Gelembung latar --}}
<div class="jk-bubbles" aria-hidden="true">
    <span></span><span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span><span></span>
</div>

<div class="jk-materi">

    {{-- ===== Header + guru kartun ===== --}}
    <div class="jk-head">
        <div>
            <h1>Materi Pembelajaran</h1>
            <p>Pilih materi di daftar, lalu mulai membaca.</p>
        </div>

        <svg class="jk-teacher" viewBox="0 0 170 150" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            {{-- papan tulis --}}
            <rect x="4" y="14" width="104" height="78" rx="7" fill="#1f6f54" stroke="#b9792f" stroke-width="5"/>
            <text x="22" y="52" font-family="Nunito, sans-serif" font-size="24" font-weight="800" fill="#e8f5ee">A B C</text>
            <path d="M22 66 H78 M22 77 H58" stroke="#e8f5ee" stroke-opacity=".6" stroke-width="2.5" stroke-linecap="round"/>
            <rect x="14" y="96" width="30" height="5" rx="2" fill="#b9792f"/>
            {{-- badan --}}
            <path d="M92 150 C92 124 108 118 130 118 C152 118 168 124 168 150 Z" fill="#f59e0b"/>
            <path d="M118 118 L130 134 L142 118 Z" fill="#fff"/>
            <path d="M126 130 L134 130 L136 148 L130 152 L124 148 Z" fill="#ef4444"/>
            {{-- leher + kepala --}}
            <rect x="123" y="106" width="14" height="14" rx="4" fill="#f2c29b"/>
            <circle cx="130" cy="86" r="25" fill="#fcd5b0"/>
            <circle cx="105" cy="88" r="5" fill="#fcd5b0"/>
            <circle cx="155" cy="88" r="5" fill="#fcd5b0"/>
            {{-- rambut --}}
            <path d="M105 82 C103 58 120 52 131 52 C145 52 158 60 155 82 C150 70 142 66 130 66 C118 66 109 70 105 82 Z" fill="#3b2a20"/>
            {{-- kacamata --}}
            <circle cx="120" cy="90" r="8" fill="#fff" fill-opacity=".55" stroke="#1e293b" stroke-width="2.2"/>
            <circle cx="141" cy="90" r="8" fill="#fff" fill-opacity=".55" stroke="#1e293b" stroke-width="2.2"/>
            <path d="M128 90 H133" stroke="#1e293b" stroke-width="2.2"/>
            <circle cx="120" cy="91" r="2.2" fill="#1e293b"/>
            <circle cx="141" cy="91" r="2.2" fill="#1e293b"/>
            {{-- senyum --}}
            <path d="M122 102 Q130.5 110 139 102" stroke="#9a3412" stroke-width="2.4" stroke-linecap="round" fill="none"/>
            {{-- tangan menunjuk papan --}}
            <path d="M96 138 C86 132 80 122 78 112" stroke="#fcd5b0" stroke-width="9" stroke-linecap="round"/>
            <path d="M78 112 L58 96" stroke="#b9792f" stroke-width="3" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="row g-3">

        {{-- ===== Daftar materi ===== --}}
        <div class="col-md-4 col-lg-3">
            <div class="jk-list-title">Daftar Materi</div>

            @forelse($list as $m)
                <a href="/materi/{{ $m->id }}"
                   class="jk-item {{ $materi && $materi->id == $m->id ? 'active' : '' }}">
                    <span class="no">{{ $loop->iteration }}</span>
                    <span>{{ $m->judul }}</span>
                </a>
            @empty
                <div class="jk-empty">Belum ada materi.</div>
            @endforelse

            {{-- tumpukan buku --}}
            <svg class="jk-books" viewBox="0 0 120 96" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="8" y="66" width="104" height="22" rx="4" fill="#3b82f6"/>
                <rect x="14" y="72" width="92" height="4" rx="2" fill="#bfdbfe"/>
                <rect x="14" y="80" width="60" height="3" rx="1.5" fill="#bfdbfe" fill-opacity=".7"/>
                <rect x="18" y="44" width="90" height="22" rx="4" fill="#f97316"/>
                <rect x="24" y="50" width="78" height="4" rx="2" fill="#fed7aa"/>
                <rect x="12" y="22" width="96" height="22" rx="4" fill="#22c55e"/>
                <rect x="18" y="28" width="84" height="4" rx="2" fill="#bbf7d0"/>
                <path d="M60 22 L60 8 L84 14 Z" fill="#ec4899"/>
                <path d="M84 14 L90 6" stroke="#ec4899" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
        </div>

        {{-- ===== Isi materi ===== --}}
        <div class="col-md-8 col-lg-9">
            @if($materi)
                <div class="jk-reader">
                    <span class="jk-badge"><i class="bi bi-journal-text"></i> Materi</span>
                    <h2>{{ $materi->judul }}</h2>

                    <div class="jk-content">{!! nl2br(e($materi->isi)) !!}</div>

                    @if($materi->soals()->count())
                        <hr class="jk-divider">
                        <a class="jk-btn" href="/kuis/{{ $materi->id }}">
                            <i class="bi bi-pencil-fill"></i> Kerjakan Kuis
                        </a>
                    @endif
                </div>
            @else
                <div class="jk-empty">
                    <svg viewBox="0 0 120 96" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect x="8" y="66" width="104" height="22" rx="4" fill="#3b82f6"/>
                        <rect x="14" y="72" width="92" height="4" rx="2" fill="#bfdbfe"/>
                        <rect x="18" y="44" width="90" height="22" rx="4" fill="#f97316"/>
                        <rect x="24" y="50" width="78" height="4" rx="2" fill="#fed7aa"/>
                        <rect x="12" y="22" width="96" height="22" rx="4" fill="#22c55e"/>
                        <rect x="18" y="28" width="84" height="4" rx="2" fill="#bbf7d0"/>
                    </svg>
                    Pilih salah satu materi di sebelah kiri untuk mulai belajar.
                </div>
            @endif
        </div>

    </div>
</div>
@endsection