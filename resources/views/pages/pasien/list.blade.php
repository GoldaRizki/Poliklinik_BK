@extends('layouts.header')

@section('isi')


@if(session()->has('pesan'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


<form class="m-5" action="{{ url($link_form) }}" method="POST">
    @csrf
    @method($method)


    <input type="hidden" name="id" value="{{ old('id', isset($pasien->id) ? $pasien->id : '') }}">

    <div class="mb-3">
        <label for="nama_form" class="form-label">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', isset($pasien->nama) ? $pasien->nama : '') }}" class="form-control @error('nama') is-invalid @enderror" id="nama_form" aria-describedby="nama">
    </div>

    <div class="form-floating">
      <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="alamat" id="floatingTextarea" style="height: 100px;" name="alamat">{{ old('alamat', isset($pasien->alamat) ? $pasien->alamat : '') }}</textarea>
      <label for="floatingTextarea">Alamat</label>
    </div>

    <div class="mb-3">
      <label for="no_ktp_form" class="form-label">NIK</label>
      <input type="text" name="no_ktp" value="{{ old('no_ktp', isset($pasien->no_ktp) ? $pasien->no_ktp : '') }}" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp_form" aria-describedby="no_ktp">
    </div>

    <div class="mb-3">
      <label for="no_hp_form" class="form-label">No HP</label>
      <input type="text" name="no_hp" value="{{ old('no_hp', isset($pasien->no_hp) ? $pasien->no_hp : '') }}" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp_form" aria-describedby="no_hp">
    </div>
    
    <div class="mb-3">
      <label for="no_rm_form" class="form-label">Rekam Medis</label>
      <input type="text" name="no_rm" value="{{ old('no_rm', isset($pasien->no_rm) ? $pasien->no_rm : '') }}" class="form-control @error('no_rm') is-invalid @enderror" id="no_rm_form" aria-describedby="no_rm">
    </div>

  
      <button type="submit" class="mt-3 btn btn-primary">Inputkan</button>
  </form>


  <table class="table">

    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>NIK</th>
        <th>No HP</th>
        <th>Rekam Medis</th>
        <th colspan="2">Aksi</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($daftar_pasien as $p)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->alamat }}</td>
          <td>{{ $p->no_ktp }}</td>
          <td>{{ $p->no_hp }}</td>
          <td>{{ $p->no_rm }}</td>
          <td><a href="{{ url('/pasien/edit/' . $p->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
          <td>
              <form action="{{ url('/pasien/delete/' . $p->id) }}" method="post">
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