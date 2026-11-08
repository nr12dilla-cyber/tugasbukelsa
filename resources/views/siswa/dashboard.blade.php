@extends('layout_siswa')

@section('isi')
@php
    $tanggal = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y');
    $kartu = [
        ['warna' => '#3b82f6', 'ikon' => 'bi-journal-text',  'nilai' => $jmlMateri, 'label' => 'Materi Tersedia',     'ket' => 'Siap kamu pelajari'],
        ['warna' => '#22c55e', 'ikon' => 'bi-trophy',        'nilai' => $rata,      'label' => 'Nilai Rata-rata Kamu', 'ket' => 'Dari semua kuis yang kamu kerjakan'],
        ['warna' => '#f97316', 'ikon' => 'bi-check2-square', 'nilai' => $jmlKuis,   'label' => 'Kuis Dikerjakan',      'ket' => 'Terus tingkatkan nilaimu'],
    ];
@endphp

<style>
    .sw-hero {
        background: linear-gradient(120deg, #2563eb, #7c3aed);
        border-radius: 24px; color: #fff;
        padding: 1.8rem 2rem; margin-bottom: 1.5rem;
        display: flex; align-items: center; justify-content: space-between; gap: 1rem;
        box-shadow: 0 18px 36px -22px rgba(37, 99, 235, .8);
    }
    .sw-hero h1 { font-size: 1.7rem; font-weight: 700; margin: 0; }
    .sw-hero p { margin: .3rem 0 .8rem; opacity: .85; }
    .sw-date {
        background: rgba(255,255,255,.18); border-radius: 999px;
        padding: .35rem .9rem; font-size: .8rem;
        display: inline-flex; align-items: center; gap: .4rem;
    }
    .sw-art { width: 190px; flex-shrink: 0; }
    .sw-stat {
        background: #fff; border-radius: 20px; padding: 1.1rem 1.2rem; height: 100%;
        display: flex; align-items: center; gap: 1rem;
        box-shadow: 0 10px 24px -16px rgba(37, 99, 235, .5);
        transition: transform .2s;
    }
    .sw-stat:hover { transform: translateY(-3px); }
    .sw-badge {
        width: 54px; height: 54px; border-radius: 16px; color: #fff;
        display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
    }
    .sw-val { font-size: 1.9rem; font-weight: 700; line-height: 1.1; }
    .sw-lbl { font-size: .88rem; font-weight: 600; }
    .sw-hint { font-size: .76rem; color: #64748b; }
    @media (max-width: 576px) { .sw-art { display: none; } }
</style>

<div class="sw-hero">
    <div>
        <h1>Halo, {{ auth()->user()->name }} 👋</h1>
        <p>Lanjutkan belajar dan pantau nilaimu di sini.</p>
        <span class="sw-date"><i class="bi bi-calendar3"></i> {{ $tanggal }}</span>
    </div>

    <svg class="sw-art" viewBox="0 0 210 110" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect x="8" y="8" width="120" height="76" rx="8" fill="#166534" stroke="#b45309" stroke-width="5"/>
        <text x="68" y="50" text-anchor="middle" font-family="Poppins, sans-serif" font-size="24" font-weight="700" fill="#fff" letter-spacing="5">ABC</text>
        <line x1="30" y1="62" x2="80" y2="62" stroke="#fff" stroke-width="2" stroke-linecap="round" opacity=".8"/>
        <rect x="20" y="86" width="34" height="6" rx="3" fill="#b45309"/>
        <ellipse cx="166" cy="48" rx="19" ry="17" fill="#ef4444"/>
        <line x1="166" y1="32" x2="168" y2="22" stroke="#78350f" stroke-width="3" stroke-linecap="round"/>
        <path d="M169 26 Q180 16 188 25 Q178 32 169 26Z" fill="#22c55e"/>
    </svg>
</div>

<div class="row g-3">
    @foreach($kartu as $k)
    <div class="col-md-4">
        <div class="sw-stat">
            <div class="sw-badge" style="background: {{ $k['warna'] }}"><i class="bi {{ $k['ikon'] }}"></i></div>
            <div>
                <div class="sw-val">{{ $k['nilai'] }}</div>
                <div class="sw-lbl">{{ $k['label'] }}</div>
                <div class="sw-hint">{{ $k['ket'] }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection