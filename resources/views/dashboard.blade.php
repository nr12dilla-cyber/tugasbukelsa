@extends('layout')

@section('isi')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        background:
            radial-gradient(900px 500px at 85% -10%, rgba(59, 130, 246, .35), transparent 60%),
            linear-gradient(165deg, #0a1640 0%, #12246b 55%, #1b3a8f 100%) fixed !important;
        min-height: 100vh;
    }

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

    .jk-dash {
        --ink: #1e293b;
        --muted: #64748b;
        font-family: 'Poppins', sans-serif;
        color: var(--ink);
        position: relative; z-index: 1;
        padding-bottom: 2rem;
    }

    .jk-head {
        color: #fff;
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        margin: .5rem 0 1.4rem;
    }
    .jk-head h1 { font-size: 1.7rem; font-weight: 700; margin: 0; }
    .jk-head p { margin: .25rem 0 .8rem; font-size: .9rem; color: rgba(255,255,255,.75); }
    .jk-date {
        font-size: .8rem; color: #dbeafe;
        background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
        padding: .4rem .9rem; border-radius: 999px;
        display: inline-flex; align-items: center; gap: .45rem;
    }
    .jk-head-art { flex-shrink: 0; width: 190px; height: auto; }

    .jk-stat {
        display: flex; align-items: center; gap: 1rem;
        height: 100%;
        background: #fff; border-radius: 20px;
        padding: 1.1rem 1.2rem;
        box-shadow: 0 18px 36px -24px rgba(0, 0, 0, .6);
        transition: transform .2s ease;
    }
    .jk-stat:hover { transform: translateY(-3px); }

    .jk-badge {
        flex-shrink: 0;
        width: 54px; height: 54px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.5rem;
    }
    .jk-badge.blue   { background: #3b82f6; }
    .jk-badge.orange { background: #f97316; }
    .jk-badge.green  { background: #22c55e; }

    .jk-stat .jk-value { font-size: 1.9rem; font-weight: 700; line-height: 1.1; }
    .jk-stat .jk-label { font-size: .88rem; font-weight: 600; margin-top: .1rem; }
    .jk-stat .jk-hint  { font-size: .76rem; color: var(--muted); margin-top: .1rem; }

    @media (max-width: 768px) { .jk-head-art { width: 120px; } }
    @media (max-width: 576px) { .jk-head-art { display: none; } }
    @media (prefers-reduced-motion: reduce) {
        .jk-bubbles span { animation: none; bottom: 20%; opacity: .5; }
    }
</style>

@php
    $tanggal = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y');
    $isGuru  = auth()->user()->role == 'guru';

    $kartu = $isGuru ? [
        ['warna' => 'blue',   'ikon' => 'bi-journal-text',   'nilai' => $jmlMateri, 'label' => 'Materi Dibuat',         'ket' => 'Total materi yang kamu unggah'],
        ['warna' => 'green',  'ikon' => 'bi-bar-chart-line', 'nilai' => $rata,      'label' => 'Rata-rata Nilai Siswa',  'ket' => 'Dari seluruh kuis yang selesai'],
        ['warna' => 'orange', 'ikon' => 'bi-check2-square',  'nilai' => $jmlKuis,   'label' => 'Total Kuis Dikerjakan',  'ket' => 'Jumlah pengerjaan oleh siswa'],
    ] : [
        ['warna' => 'blue',   'ikon' => 'bi-journal-text',   'nilai' => $jmlMateri, 'label' => 'Materi Tersedia',       'ket' => 'Siap kamu pelajari'],
        ['warna' => 'green',  'ikon' => 'bi-trophy',         'nilai' => $rata,      'label' => 'Nilai Rata-rata Kamu',   'ket' => 'Dari semua kuis yang kamu kerjakan'],
        ['warna' => 'orange', 'ikon' => 'bi-check2-square',  'nilai' => $jmlKuis,   'label' => 'Kuis Dikerjakan',        'ket' => 'Terus tingkatkan nilaimu'],
    ];
@endphp

<div class="jk-bubbles" aria-hidden="true">
    <span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span>
</div>

<div class="jk-dash">

    <div class="jk-head">
        <div>
            <h1>Beranda</h1>
            @if($isGuru)
                <p>Ringkasan aktivitas pembelajaran di JarKomDas.</p>
            @else
                <p>Lanjutkan belajar dan pantau nilaimu di sini.</p>
            @endif
            <span class="jk-date"><i class="bi bi-calendar3"></i> {{ $tanggal }}</span>
        </div>

        <svg class="jk-head-art" viewBox="0 0 210 110" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <rect x="8" y="8" width="120" height="76" rx="8" fill="#166534" stroke="#b45309" stroke-width="5"/>
            <text x="68" y="50" text-anchor="middle" font-family="Poppins, sans-serif" font-size="24" font-weight="700" fill="#fff" letter-spacing="5">ABC</text>
            <line x1="30" y1="62" x2="80" y2="62" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".8"/>
            <line x1="30" y1="71" x2="58" y2="71" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".6"/>
            <rect x="20" y="86" width="34" height="6" rx="3" fill="#b45309"/>
            <rect x="62" y="87" width="12" height="4" rx="2" fill="#fff"/>
            <ellipse cx="166" cy="48" rx="19" ry="17" fill="#ef4444"/>
            <ellipse cx="160" cy="42" rx="5" ry="3.5" fill="#fff" opacity=".35"/>
            <line x1="166" y1="32" x2="168" y2="22" stroke="#78350f" stroke-width="3" stroke-linecap="round"/>
            <path d="M169 26 Q180 16 188 25 Q178 32 169 26Z" fill="#22c55e"/>
            <g transform="translate(136 100) rotate(-24)">
                <rect x="-8" y="-5" width="8" height="10" rx="2" fill="#f472b6"/>
                <rect x="0" y="-5" width="3" height="10" fill="#94a3b8"/>
                <rect x="3" y="-5" width="46" height="10" fill="#fbbf24"/>
                <polygon points="49,-5 63,0 49,5" fill="#fde68a"/>
                <polygon points="59,-1.6 63,0 59,1.6" fill="#1e293b"/>
            </g>
        </svg>
    </div>

    <div class="row g-3">
        @foreach($kartu as $k)
        <div class="col-md-4">
            <div class="jk-stat">
                <div class="jk-badge {{ $k['warna'] }}"><i class="bi {{ $k['ikon'] }}"></i></div>
                <div>
                    <div class="jk-value">{{ $k['nilai'] }}</div>
                    <div class="jk-label">{{ $k['label'] }}</div>
                    <div class="jk-hint">{{ $k['ket'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection