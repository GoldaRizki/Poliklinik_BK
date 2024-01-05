@extends('layouts.header')

@section('isi')
<form class="m-5" action="{{ url('/dokter/profile/edit/') }}" method="POST">
    <h3>Akun Anda</h3>
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ old('id', isset($dokter->id) ? $dokter->id : '') }}">
      <div class="mb-3">
        <label for="nama_form" class="form-label">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', isset($dokter->nama) ? $dokter->nama : '') }}" class="form-control @error('nama') is-invalid @enderror" id="nama_form" aria-describedby="nama_">
      </div>
      <div class="mb-3">
        <label for="alamat_form" class="form-label">Alamat</label>
        <input name="alamat" type="text" value="{{ old('alamat', isset($dokter->alamat) ? $dokter->alamat : '') }}"  class="form-control @error('alamat') is-invalid @enderror" id="alamat_form">
      </div>
      <div class="mb-3">
          <label for="no_hp_form" class="form-label">Nomor HP</label>
          <input name="no_hp" type="text" value="{{ old('no_hp', isset($dokter->no_hp) ? $dokter->no_hp : '') }}" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp_form">
      </div>

      <button type="submit" class="mt-3 btn btn-primary">Masukkan</button>
  </form>

  <form class="m-5" action="{{ url('/dokter/password/edit/') }}" method="post">
    <h3>Ganti password</h3>
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ old('id', isset($dokter->id) ? $dokter->id : '') }}">

    <div class="mb-3">
        <label for="password_form" class="form-label">Password</label>
        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password_form">
    </div>

    <div class="mb-3">
        <label for="password_baru_form" class="form-label">Password Baru</label>
        <input name="password_baru" type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru_form">
    </div>

    <button type="submit" class="mt-3 btn btn-primary">Masukkan</button>
  </form>


@endsection