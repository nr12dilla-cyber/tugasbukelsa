@extends('layout')
@section('isi')

<style>
    /* ===== Latar gradasi biru tua seperti halaman Materi ===== */
    body {
        background: linear-gradient(160deg, #0a1740 0%, #10297a 45%, #1e4fd8 100%) fixed !important;
        min-height: 100vh;
    }

    .laporan-page {
        position: relative;
        z-index: 1;
    }

    /* ===== Bubble dekorasi ===== */
    .bubbles {
        position: fixed;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }
    .bubble {
        position: absolute;
        bottom: -160px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(255,255,255,.35), rgba(255,255,255,.06) 70%);
        border: 1px solid rgba(255,255,255,.18);
        animation: naik linear infinite;
    }
    .bubble:nth-child(1)  { left: 5%;  width: 60px;  height: 60px;  animation-duration: 16s; animation-delay: 0s; }
    .bubble:nth-child(2)  { left: 15%; width: 110px; height: 110px; animation-duration: 22s; animation-delay: 3s; }
    .bubble:nth-child(3)  { left: 28%; width: 40px;  height: 40px;  animation-duration: 14s; animation-delay: 6s; }
    .bubble:nth-child(4)  { left: 40%; width: 90px;  height: 90px;  animation-duration: 20s; animation-delay: 1s; }
    .bubble:nth-child(5)  { left: 55%; width: 50px;  height: 50px;  animation-duration: 17s; animation-delay: 8s; }
    .bubble:nth-child(6)  { left: 68%; width: 130px; height: 130px; animation-duration: 25s; animation-delay: 4s; }
    .bubble:nth-child(7)  { left: 80%; width: 70px;  height: 70px;  animation-duration: 18s; animation-delay: 10s; }
    .bubble:nth-child(8)  { left: 90%; width: 45px;  height: 45px;  animation-duration: 15s; animation-delay: 2s; }
    .bubble:nth-child(9)  { left: 48%; width: 25px;  height: 25px;  animation-duration: 12s; animation-delay: 5s; }
    .bubble:nth-child(10) { left: 22%; width: 80px;  height: 80px;  animation-duration: 21s; animation-delay: 12s; }

    @keyframes naik {
        0%   { transform: translateY(0) translateX(0); opacity: 0; }
        10%  { opacity: 1; }
        50%  { transform: translateY(-60vh) translateX(25px); }
        100% { transform: translateY(-120vh) translateX(-15px); opacity: 0; }
    }

    /* ===== Judul ===== */
    .laporan-title {
        color: #fff;
        font-weight: 800;
        margin: 0;
    }
    .laporan-sub {
        color: rgba(255,255,255,.8);
        margin: 0;
    }

    /* ===== Tombol cetak ===== */
    .btn-cetak {
        background: linear-gradient(135deg, #f97316, #ef4444);
        border: 0;
        color: #fff;
        font-weight: 600;
        border-radius: 14px;
        padding: .6rem 1.2rem;
        box-shadow: 0 8px 20px rgba(239, 68, 68, .35);
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .btn-cetak:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(239, 68, 68, .45);
    }

    /* ===== Kartu putih membulat ===== */
    .card-laporan {
        background: #fff;
        border: 0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .3);
        position: relative;
    }

    .table-laporan {
        margin: 0;
        --bs-table-striped-bg: #f4f7ff;
    }
    .table-laporan thead th {
        background: #eaf0ff;
        color: #1e3a8a;
        font-size: .8rem;
        letter-spacing: .08em;
        text-transform: uppercase;
        border: 1px solid #b6c6f0;
        border-top: 0;
    }
    .table-laporan tbody td {
        border: 1px solid #c7d4f5;
        color: #1f2937;
    }
    /* hilangkan garis di sisi terluar supaya tetap rapi di kartu membulat */
    .table-laporan th:first-child,
    .table-laporan td:first-child { border-left: 0; }
    .table-laporan th:last-child,
    .table-laporan td:last-child  { border-right: 0; }
    .table-laporan tbody tr:last-child td { border-bottom: 0; }
    .table-laporan tbody tr:hover td {
        background: #fff3c4;
    }

    /* ===== Badge nilai ===== */
    .badge-nilai {
        display: inline-block;
        min-width: 48px;
        padding: .45rem .8rem;
        border-radius: 12px;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
    }
    .badge-lulus  { background: #22c55e; }
    .badge-gagal  { background: #ef4444; }

    /* ===== Saat dicetak / disimpan ke PDF ===== */
    /* elemen khusus cetak: disembunyikan di layar */
    .print-only { display: none; }

    @media print {
        /* ===== Kertas A4 formal ===== */
        @page {
            size: A4 portrait;
            margin: 20mm 18mm;
        }
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        nav, .no-print, .bubbles, .screen-only {
            display: none !important;
        }
        .print-only { display: block !important; }
        th.print-only, td.print-only { display: table-cell !important; }

        html, body {
            background: #fff !important;
            color: #000 !important;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12pt !important;
        }
        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Kop laporan */
        .kop {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 18px;
        }
        .kop h2 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .kop p {
            margin: 2px 0 0;
            font-size: 11pt;
        }
        .info-cetak {
            font-size: 11pt;
            margin-bottom: 12px;
        }

        /* Kartu & tabel formal */
        .card-laporan {
            background: #fff !important;
            border: 0 !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            overflow: visible !important;
        }
        .table-laporan {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 11pt;
        }
        .table-laporan thead th {
            background: #e5e5e5 !important;
            color: #000 !important;
            border: 1px solid #000 !important;
            font-size: 10.5pt;
            letter-spacing: 0;
            padding: 8px 6px !important;
            text-align: center !important;
        }
        .table-laporan tbody td {
            background: #fff !important;
            color: #000 !important;
            border: 1px solid #000 !important;
            padding: 7px 8px !important;
            text-align: left;
        }
        .table-laporan tbody td.text-center { text-align: center !important; }
        .table-laporan tbody td.text-primary,
        .table-laporan tbody td.text-muted { color: #000 !important; }
        .table-laporan tbody td.text-end { text-align: center !important; }
        .table-laporan tr { break-inside: avoid; }
        .table-laporan thead { display: table-header-group; }

        /* Nilai jadi angka biasa (tanpa warna badge) */
        .badge-nilai {
            background: none !important;
            color: #000 !important;
            padding: 0 !important;
            min-width: 0 !important;
            border-radius: 0 !important;
            font-weight: bold;
            font-size: 11pt;
        }

        /* Tanda tangan */
        .ttd {
            margin-top: 40px;
            margin-left: 60%;
            text-align: center;
            font-size: 11pt;
            break-inside: avoid;
        }
        .ttd .nama {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
    }
</style>

{{-- Bubble dekorasi --}}
<div class="bubbles" aria-hidden="true">
    @for($i = 0; $i < 10; $i++)
        <span class="bubble"></span>
    @endfor
</div>

<div class="laporan-page">

    {{-- Kop khusus cetak (formal A4) --}}
    <div class="print-only">
        <div class="kop">
            <h2>Laporan Hasil Belajar Siswa</h2>
        </div>
        <div class="info-cetak">
            Tanggal cetak : {{ now()->format('d/m/Y H:i') }} WIB
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 screen-only">
        <div>
            <h3 class="laporan-title">Laporan Hasil Belajar Siswa</h3>
            <p class="laporan-sub">Daftar nilai kuis seluruh siswa.</p>
        </div>

        {{-- Tombol Cetak PDF --}}
        <button onclick="window.print()" class="btn btn-cetak no-print">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf me-1" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                <path d="M4.603 12.087a.8.8 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.027.137-.164.387-.284.626-.284.18 0 .323.064.44.183.212.215.358.591.433.992a6.8 6.8 0 0 1-.367.432c-.22.232-.511.232-.774.124zm2.149-1.266c.074.124.16.27.248.438.204.389.378.783.504 1.127.182.497.182.885.02 1.096-.12.158-.337.246-.576.246-.24 0-.442-.088-.576-.246-.162-.211-.162-.6 0-1.096a12 12 0 0 1 .38-.865zm2.871-3.61c.143 0 .285.044.398.132.222.173.284.455.181.71-.091.226-.307.398-.567.48a12 12 0 0 1-.795.195c.01-.132.02-.267.02-.403 0-.31-.05-.58-.15-.8a.7.7 0 0 1 .913-.314"/>
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="card-laporan">
        <div class="p-0">
            <table class="table table-striped table-laporan align-middle">
                <thead>
                    <tr>
                        <th class="py-3 px-4 text-center" style="width: 70px;">No</th>
                        <th class="py-3 px-3">Siswa</th>
                        <th class="py-3 px-3">Kuis</th>
                        <th class="py-3 px-3 text-center">Nilai</th>
                        <th class="py-3 px-4 text-end">Waktu</th>
                        <th class="print-only">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $n)
                    <tr>
                        <td class="py-3 px-4 text-center fw-bold text-primary">{{ $loop->iteration }}</td>
                        <td class="py-3 px-3 fw-semibold">{{ $n->user->name }}</td>
                        <td class="py-3 px-3">{{ $n->materi->judul }}</td>
                        <td class="py-3 px-3 text-center">
                            <span class="badge-nilai {{ $n->skor >= 70 ? 'badge-lulus' : 'badge-gagal' }}">
                                {{ $n->skor }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-end text-muted">{{ $n->created_at->format('d/m/Y H:i') }}</td>
                        <td class="print-only text-center">{{ $n->skor >= 70 ? 'Lulus' : 'Belum Lulus' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tanda tangan khusus cetak --}}
    <div class="print-only ttd">
        <div>Mengetahui,</div>
        <div>Guru Pengampu</div>
        <div class="nama">{{ auth()->user()->name ?? '........................' }}</div>
    </div>

</div>

@endsection