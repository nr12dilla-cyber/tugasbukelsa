@extends('layout_siswa')

@section('isi')
<h3 class="fw-bold mb-4">Nilai Saya</h3>

<div class="card border-0 shadow-sm rounded-4">
    <table class="table mb-0">
        <thead><tr><th>Materi</th><th>Skor</th></tr></thead>
        <tbody>
        @forelse($riwayat as $n)
            <tr>
                <td>{{ $n->materi->judul ?? '-' }}</td>
                <td>{{ $n->skor }}</td>
            </tr>
        @empty
            <tr><td colspan="2" class="text-muted">Belum ada nilai.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection