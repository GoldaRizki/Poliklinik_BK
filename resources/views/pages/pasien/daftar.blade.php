@extends('layouts.header')

@section('isi')
    
@if(session()->has('no_rekam_medis'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <strong>Pendaftaran Berhasil!</strong> Nomor Rekam medis anda adalah : {{ session('no_rekam_medis') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@error('telah_terdaftar')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Pasien telah terdaftar!!!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@enderror

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#form-daftar-pasien" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Pendaftaran Pasien Baru</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#form-daftar-poli" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Daftar Poliklinik</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="form-daftar-pasien" role="tabpanel" aria-labelledby="home-tab" tabindex="0">



        <form action="{{ url('/pasien/daftar') }}" method="post">
            @csrf
        <div class="mb-3">
            <label for="nama_form" class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" id="nama_form" aria-describedby="nama">
        </div>
        
        <div class="form-floating">
            <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" id="floatingTextarea" name="alamat">{{ old('alamat')}}</textarea>
            <label for="floatingTextarea">Alamat</label>
          </div>
        
        <div class="mb-3">
            <label for="no_ktp_form" class="form-label">NIK</label>
            <input type="text" name="no_ktp" value="{{ old('no_ktp')}}" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp_form" aria-describedby="no_ktp">
        </div>
        
        <div class="mb-3">
            <label for="no_hp_form" class="form-label">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp_form" aria-describedby="no_hp">
        </div>
        
        <button type="submit" class="mt-4 btn btn-primary">Daftar</button>
        
        </form>
    </div>

    <div class="tab-pane fade" id="form-daftar-poli" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        
    <h1>Iki gawe daftar poliklinik</h1>
    
    </div>
    
  </div>



@endsection