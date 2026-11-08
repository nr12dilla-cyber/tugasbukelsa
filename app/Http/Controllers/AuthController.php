<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function form() { return view('login'); }
    public function login(Request $r) {
        $c = $r->validate(['username'=>'required','password'=>'required']);
        if (Auth::attempt($c)) { $r->session()->regenerate(); return redirect('/'); }
        return back()->withErrors(['username'=>'Username atau kata sandi salah.'])->onlyInput('username');
    }
    public function logout(Request $r) {
        Auth::logout(); $r->session()->invalidate(); $r->session()->regenerateToken();
        return redirect('/login');
    }
}
