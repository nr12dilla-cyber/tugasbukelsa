<?php
namespace App\Http\Controllers;
use App\Models\{Materi,Nilai};
use Illuminate\Http\Request;

class KuisController extends Controller {
    public function show(Materi $materi) {
        return view('kuis', ['materi'=>$materi, 'soals'=>$materi->soals()->inRandomOrder()->get()]);
    }
    public function submit(Request $r, Materi $materi) {
        $soals = $materi->soals; $benar = 0;
        foreach ($soals as $s) if ($r->input("j.$s->id") === $s->jawaban) $benar++;
        $skor = $soals->count() ? round($benar / $soals->count() * 100) : 0;
        Nilai::create(['user_id'=>auth()->id(), 'materi_id'=>$materi->id, 'skor'=>$skor]);
        return redirect('/')->with('ok', "Kuis selesai. Nilai kamu: $skor ($benar dari {$soals->count()} benar).");
    }
}
