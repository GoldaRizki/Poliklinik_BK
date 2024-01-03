@extends('layouts.header')

@section('isi')
    
@if(session()->has('pesan'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('pesan') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form action="/periksa" method="post">

    @csrf

    <input type="hidden" name="id" value="{{ old('id', isset($periksa->id) ? $periksa->id : '') }}">
    <input type="hidden" name="daftar_poli_id" value="{{ old('daftar_poli_id', isset($periksa->daftar_poli_id) ? $periksa->daftar_poli_id : '') }}">

    <div class="mb-3">
        <label for="tanggal_periksa_form">Tanggal diperiksa</label>
        <input  type="date" id="tanggal_periksa_form" class="form-control @error('tgl_periksa') is-invalid @enderror" name="tgl_periksa" value="{{ old('tgl_periksa', isset($periksa->tgl_periksa) ? Illuminate\Support\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d') : '') }}">
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control @error('catatan') is-invalid @enderror" placeholder="catatan . . . " id="floatingTextarea" style="height: 200px" name="catatan">{{ old('catatan', isset($periksa->catatan) ? $periksa->catatan : '') }}</textarea>
        <label for="floatingTextarea">Catatan</label>
    </div>

    <button class="btn btn-primary btn-sm" type="submit">Simpan perubahan</button>

</form>

<div class="container-fluid my-5">

    <form action="/periksa/obat/tambah" method="post">
        
        @csrf
        <input type="hidden" name="periksa_id" value="{{ old('periksa_id', isset($periksa->id) ? $periksa->id : '') }}">

        <div class="mb-3">
            <label for="obat_form" class="form-label">Obat</label>
          <select class="form-select @error('obat_id') is-invalid @enderror" aria-label="Pilihan" id="obat_form" name="obat_id">
            <option value="{{ old('obat_id') }}" selected></option>
            
            @foreach ($obat as $o)
            <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
            @endforeach
        
          </select>
          </div>

        <button class="btn btn-primary btn-sm" type="submit">+ Tambahkan Obat</button>

    </form>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kemasan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periksa->detail_periksa as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->obat->nama_obat }}</td>
                    <td>{{ $d->obat->kemasan }}</td>
                    <td>{{ $d->obat->harga }}</td>
                    <td>
                        <form action="{{ url('/periksa/obat/delete/' . $d->id) }}" method="post">
                          @method('delete')
                          @csrf
                          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection