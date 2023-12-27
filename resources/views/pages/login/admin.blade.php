@extends('layouts.header')


@section('isi')
    <h4 class="text-center">Login sebagi admin</h4>
<form class="m-5" action="{{ url('/adminLogin') }}" method="POST">
  @csrf
    <div class="mb-3">
      <label for="username_form" class="form-label">Username</label>
      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="username_form" aria-describedby="username">
    </div>
    <div class="mb-3">
      <label for="password_form" class="form-label">Password</label>
      <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password_form">
    </div>
    @error('login_gagal')
      <p class="text-danger">{{ $message }}</p>
    @enderror


    

    <button type="submit" class="btn btn-primary">Login</button>
</form>

@endsection