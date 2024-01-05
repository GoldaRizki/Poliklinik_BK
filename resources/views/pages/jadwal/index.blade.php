@extends('layouts.header')


@section('isi')
    <h4>Jadwal</h4>

    @error('input_tidak_valid')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror

    @error('jadwal_tabrakan')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror

<form class="m-5" action="{{ url($link_form) }}" method="POST">
  @csrf
  @method($method)
  <input type="hidden" name="id" value="{{ old('id', isset($jadwalPeriksa->id) ? $jadwalPeriksa->id : '') }}">
  <input type="hidden" name="dokter_id" value="1">
  
  <select class="form-select @error('hari') is-invalid @enderror" aria-label="Hari" name="hari">
    <option value="{{ old('hari', isset($jadwalPeriksa->hari) ? $jadwalPeriksa->hari : '') }}" selected>{{ old('hari', isset($jadwalPeriksa->hari) ? $jadwalPeriksa->hari : '  ----Pilih Hari----  ') }}</option>

    <option value="Senin">Senin</option>
    <option value="Selasa">Selasa</option>
    <option value="Rabu">Rabu</option>
    <option value="Kamis">Kamis</option>
    <option value="Jumat">Jumat</option>
    <option value="Sabtu">Sabtu</option>
    <option value="Minggu">Minggu</option>


  </select>

    <div class="mb-3">
      <label for="jam_mulai_form" class="form-label">Jam Mulai</label>
      <input type="time" name="jam_mulai" value="{{ old('jam_mulai', isset($jadwalPeriksa->jam_mulai) ? $jadwalPeriksa->jam_mulai : '') }}" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai_form" aria-describedby="jam_mulai">
    </div>
    <div class="mb-3">
      <label for="jam_selesai_form" class="form-label">Jam Selesai</label>
      <input type="time" name="jam_selesai" value="{{ old('jam_selesai', isset($jadwalPeriksa->jam_selesai) ? $jadwalPeriksa->jam_selesai : '') }}" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_selesai_form" aria-describedby="jam_selesai">
    </div>

    <button type="submit" class="mt-3 btn btn-primary">Inputkan</button>
</form>


<table class="table">

  <thead>
    <tr>
      <th>No</th>
      <th>Dokter</th>
      <th>Hari</th>
      <th>Jam Mulai</th>
      <th>Jan Selesai</th>
      <th class="text-center" colspan="2">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($jadwal as $j)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $j->dokter->nama }}</td>
        <td>{{ $j->hari }}</td>
        <td>{{ $j->jam_mulai }}</td>
        <td>{{ $j->jam_selesai }}</td>
        <td><a href="{{ url('/jadwal/edit/' . $j->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
        <td>
            <form action="{{ url('/jadwal/delete/' . $j->id) }}" method="post">
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