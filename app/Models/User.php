<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    protected $fillable = ['name','username','role','password'];
    protected $hidden = ['password','remember_token'];
    public function nilais() { return $this->hasMany(Nilai::class); }
}
