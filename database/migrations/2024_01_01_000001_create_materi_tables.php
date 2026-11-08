<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('materis', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete(); // guru pengunggah
            $t->string('judul');
            $t->longText('isi');
            $t->unsignedInteger('urutan')->default(0);
            $t->timestamps();
        });
        Schema::create('soals', function (Blueprint $t) {
            $t->id();
            $t->foreignId('materi_id')->constrained()->cascadeOnDelete();
            $t->text('pertanyaan');
            $t->string('opsi_a'); $t->string('opsi_b'); $t->string('opsi_c'); $t->string('opsi_d');
            $t->char('jawaban', 1); // a/b/c/d
            $t->timestamps();
        });
        Schema::create('nilais', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->foreignId('materi_id')->constrained()->cascadeOnDelete();
            $t->unsignedTinyInteger('skor');
            $t->timestamps();
        });
        Schema::create('diskusis', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->text('isi');
            $t->timestamps();
        });
    }
    public function down(): void {
        foreach (['diskusis','nilais','soals','materis'] as $x) Schema::dropIfExists($x);
    }
};
