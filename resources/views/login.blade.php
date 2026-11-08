@extends('layout')
@section('isi')
<div class="card mx-auto" style="max-width:380px"><div class="card-body">
<h4>JarKomDas</h4><p class="text-muted">Masuk dengan NIS/username.</p>
<form method="POST" action="/login">@csrf
<label class="mt-2">NIS / username</label><input name="username" class="form-control" value="{{ old('username') }}" required>
@error('username')<div class="text-danger small">{{ $message }}</div>@enderror
<label class="mt-2">Kata sandi</label><input type="password" name="password" class="form-control" required>
<button class="btn btn-primary w-100 mt-3">Masuk</button></form></div></div>
@endsection
