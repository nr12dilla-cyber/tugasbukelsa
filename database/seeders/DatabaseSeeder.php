<?php
namespace Database\Seeders;
use App\Models\{User,Materi,Soal};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $g = User::create(['name'=>'Guru TKJ','username'=>'guru','role'=>'guru','password'=>Hash::make('guru123')]);
        User::create(['name'=>'Siswa Contoh','username'=>'siswa','role'=>'siswa','password'=>Hash::make('siswa123')]);
        $m = [
          ['Konsep Dasar Jaringan','Jaringan komputer adalah dua perangkat atau lebih yang terhubung untuk berbagi data dan sumber daya. Jenisnya: LAN, MAN, WAN.'],
          ['Topologi Jaringan','Topologi adalah pola susunan perangkat jaringan: bus, star, ring, mesh, dan hybrid.'],
          ['Perangkat Jaringan','NIC, hub, switch, router, modem, dan kabel UTP.'],
          ['Pengalamatan IP','IPv4 terdiri dari 4 oktet, misalnya 192.168.1.10. Kelas A, B, C. Subnetting membagi jaringan.'],
          ['Protokol Komunikasi','TCP/IP dan model OSI 7 lapisan.'],
        ];
        foreach ($m as $i => [$j,$s]) Materi::create(['user_id'=>$g->id,'judul'=>$j,'isi'=>$s,'urutan'=>$i+1]);
        $q = [
          ['Topologi dengan satu titik pusat (switch/hub) adalah…','Bus','Star','Ring','Mesh','b'],
          ['Kelemahan utama topologi bus adalah…','Biaya mahal','Kabel utama putus mengganggu seluruh jaringan','Butuh banyak port','Tidak bisa untuk LAN','b'],
          ['Topologi yang setiap perangkatnya terhubung ke semua perangkat lain…','Bus','Star','Ring','Mesh','d'],
          ['Pada topologi ring, data mengalir…','Ke semua arah','Hanya lewat satu kabel utama','Melingkar satu arah','Lewat satu router','c'],
        ];
        foreach ($q as $x) Soal::create(['materi_id'=>2,'pertanyaan'=>$x[0],'opsi_a'=>$x[1],'opsi_b'=>$x[2],'opsi_c'=>$x[3],'opsi_d'=>$x[4],'jawaban'=>$x[5]]);
    }
}
