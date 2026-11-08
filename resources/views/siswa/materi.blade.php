@extends('layout_siswa')

@section('isi')
<h3 class="fw-bold mb-4">Materi</h3>

<div class="row g-3">
    {{-- Daftar materi (kiri) --}}
    <div class="col-md-4">
        <div class="list-group shadow-sm rounded-4">
            @foreach($list as $m)
                <a href="/materi/{{ $m->id }}"
                   class="list-group-item list-group-item-action {{ $materi && $materi->id == $m->id ? 'active' : '' }}">
                    {{ $m->judul }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Isi materi yang dibuka (kanan) --}}
    <div class="col-md-8">
        @if($materi)
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold">{{ $materi->judul }}</h4>
                <div class="mt-3">{!! nl2br(e($materi->isi)) !!}</div>
                <a href="/kuis/{{ $materi->id }}" class="btn btn-primary mt-4">
                    <i class="bi bi-patch-question"></i> Kerjakan Kuis
                </a>
            </div>
        @else
            <p class="text-muted">Belum ada materi.</p>
        @endif
    </div>
</div>
@endsection