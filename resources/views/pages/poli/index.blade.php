@extends('layouts.header')


@section('isi')
    <h4>Input Obat</h4>
<form class="m-5" action="{{ url($link_form) }}" method="POST">
  @csrf
  @method($method)
  <input type="hidden" name="id" value="{{ old('id', isset($poli->id) ? $poli->id : '') }}">
    <div class="mb-3">
      <label for="nama_poli_form" class="form-label">Nama Poli</label>
      <input type="text" name="nama_poli" value="{{ old('nama_poli', isset($poli->nama_poli) ? $poli->nama_poli : '') }}" class="form-control @error('nama_poli') is-invalid @enderror" id="nama_poli_form" aria-describedby="nama_poli">
    </div>

    <div class="form-floating">
      <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan" id="floatingTextarea" name="keterangan">{{ old('keterangan', isset($poli->keterangan) ? $poli->keterangan : '') }}</textarea>
      <label for="floatingTextarea">Keterangan</label>
    </div>


    <button type="submit" class="mt-4 btn btn-primary">Masukkan</button>
</form>


<table class="table">

  <thead>
    <tr>
      <th>No</th>
      <th>Nama Poli</th>
      <th>Keterangan</th>

      <th colspan="2">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($daftar_poli as $pol)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pol->nama_poli }}</td>
        <td>{{ $pol->keterangan }}</td>
        <td><a href="{{ url('/poli/edit/' . $pol->id) }}" class="btn btn-sm btn-warning">Edit</a></td>
        <td>
            <form action="{{ url('/poli/delete/' . $pol->id) }}" method="post">
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