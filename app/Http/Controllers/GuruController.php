<?php

namespace App\Http\Controllers;

use App\Models\{Materi, Nilai, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller {
    
    private function guru() { 
        abort_unless(auth()->user()->role === 'guru', 403); 
    }

    public function laporan() {
        $this->guru();
        return view('guru.laporan', ['data' => Nilai::with(['user', 'materi'])->latest()->get()]);
    }

    public function create() { 
        $this->guru(); 
        return view('guru.materi_form'); 
    }

    public function store(Request $r) {
        $this->guru();
        $d = $r->validate([
            'judul'  => 'required|max:150',
            'isi'    => 'required',
            'urutan' => 'nullable|integer'
        ]);

        // Menyimpan data dengan memastikan 'urutan' tidak bernilai null
        Materi::create([
            'judul'   => $d['judul'],
            'isi'     => $d['isi'],
            'urutan'  => $d['urutan'] ?? (Materi::max('urutan') + 1), // Otomatis jadi urutan terakhir + 1 jika dikosongkan
            'user_id' => auth()->id(),
        ]);

        return redirect('/materi')->with('ok', 'Materi berhasil ditambahkan.');
    }

    // --- FITUR BARU: KELOLA & DAFTARKAN SISWA ---

    // Menampilkan daftar siswa & form pendaftaran siswa
    public function siswa() {
        $this->guru();
        $siswas = User::where('role', 'siswa')->latest()->get();
        return view('guru.siswa', compact('siswas'));
    }

    // Memproses pembuatan akun siswa baru oleh Guru
    public function storeSiswa(Request $r) {
        $this->guru();
        $d = $r->validate([
            'name'     => 'required|string|max:150',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:4'
        ]);

        User::create([
            'name'     => $d['name'],
            'username' => $d['username'],
            'password' => Hash::make($d['password']),
            'role'     => 'siswa'
        ]);

        return redirect('/guru/siswa')->with('ok', 'Akun siswa berhasil didaftarkan!');
    }
}