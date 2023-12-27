@extends('layouts.header')


@section('isi')
    <h4>Input Obat</h4>
<form class="m-5" action="{{ url($link_form) }}" method="POST">
  @csrf
  @method($method)
  <input type="hidden" name="id" value="{{ old('id', isset($obat->id) ? $obat->id : '') }}">
    <div class="mb-3">
      <label for="nama_obat_form" class="form-label">Nama Obat</label>
      <input type="text" name="nama_obat" value="{{ old('nama_obat', isset($obat->nama_obat) ? $obat->nama_obat : '') }}" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat_form" aria-describedby="nama_obat">
    </div>
    <div class="mb-3">
      <label for="kemasan_form" class="form-label">Kemasan</label>
      <input name="kemasan" type="text" value="{{ old('kemasan', isset($obat->kemasan) ? $obat->kemasan : '') }}"  class="form-control @error('kemasan') is-invalid @enderror" id="kemasan_form">
    </div>
    <div class="mb-3">
        <label for="harga_form" class="form-label">Harga</label>
        <input name="harga" type="text" value="{{ old('harga', isset($obat->harga) ? $obat->harga : '') }}" class="form-control @error('harga') is-invalid @enderror" id="harga_form">
    </div>


    <button type="submit" class="btn btn-primary">Masukkan</button>
</form>


<table class="table">

  <thead>
    <tr>
      <th>No</th>
      <th>Nama Obat</th>
      <th>Kemasan</th>
      <th>Harga</th>
      <th colspan="2">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($daftar_obat as $ob)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $ob->nama_obat }}</td>
        <td>{{ $ob->kemasan }}</td>
        <td>{{ $ob->harga }}</td>
        <td><a href="{{ url('/obat/edit/' . $ob->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
        <td>
            <form action="{{ url('/obat/delete/' . $ob->id) }}" method="post">
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