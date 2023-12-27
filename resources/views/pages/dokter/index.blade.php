@extends('layouts.header')


@section('isi')
    <h4>Nama Dokter</h4>
<form class="m-5" action="{{ url($link_form) }}" method="POST">
  @csrf
  @method($method)
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
    <div class="mb-3">
      <label for="password_form" class="form-label">Password</label>
      <input name="password" type="text" value="{{ old('password', isset($dokter->password) ? $dokter->password : '') }}" class="form-control @error('password') is-invalid @enderror" id="password_form">
  </div>

  <select class="form-select" aria-label="Pilihan" name="poli_id">
    <option value="{{ old('poli_id', isset($dokter->poli_id) ? $dokter->poli_id : '') }}" selected>{{ isset($dokter->poli_id) ? $dokter->poli->nama_poli : 'Silahkan Pilih' }}</option>
    @foreach ($poli as $p)
    <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>

    @endforeach

  </select>

    <button type="submit" class="mt-3 btn btn-primary">Masukkan</button>
</form>


<table class="table">

  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Nomor HP</th>
      <th>Password</th>
      <th colspan="2">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($daftar_dokter as $dok)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $dok->nama }}</td>
        <td>{{ $dok->alamat }}</td>
        <td>{{ $dok->no_hp }}</td>
        <td>{{ $dok->password }}</td>
        <td><a href="{{ url('/dokter/edit/' . $dok->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
        <td>
            <form action="{{ url('/dokter/delete/' . $dok->id) }}" method="post">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>

</table>


@endsection