<?php
namespace App\Http\Controllers;
use App\Models\{Materi,Nilai,Diskusi};
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function dashboard() {
        $u = auth()->user();
        $nilai = Nilai::where('user_id',$u->id);

        $data = [
            'jmlMateri' => Materi::count(),
            'jmlKuis'   => (clone $nilai)->count(),
            'rata'      => round((clone $nilai)->avg('skor') ?? 0),
        ];

        return view($u->role == 'guru' ? 'dashboard' : 'siswa.dashboard', $data);
    }

    public function materi(Materi $materi = null) {
        $list = Materi::orderBy('urutan')->get();
        $data = ['list'=>$list, 'materi'=>$materi ?? $list->first()];

        return view(auth()->user()->role == 'guru' ? 'guru.materiguru' : 'siswa.materi', $data);
    }

    public function nilai() {
        $riwayat = Nilai::with('materi')
            ->where('user_id', auth()->id())
            ->latest()->get();

        return view('siswa.nilai', compact('riwayat'));
    }

    public function diskusi() {
        return view('diskusi', ['posts'=>Diskusi::with('user')->latest()->get()]);
    }
    public function kirim(Request $r) {
        $d = $r->validate(['isi'=>'required|max:1000']);
        Diskusi::create(['user_id'=>auth()->id(), 'isi'=>$d['isi']]);
        return back();
    }
}