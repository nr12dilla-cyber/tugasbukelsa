<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model {
    protected $fillable = ['user_id','judul','isi','urutan'];
    public function soals() { return $this->hasMany(Soal::class); }
}
