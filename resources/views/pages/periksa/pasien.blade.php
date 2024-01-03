@extends('layouts.header')

@section('isi')

<table class="table table-hover">

    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Keluhan</th>
            <th colspan="2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($jadwalGlobal as $jadwal)
        @foreach ($jadwal->daftar_poli as $j)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $j->pasien->nama }}</td>
                <td>{{ $j->keluhan }}</td>
                <td>
                    @if($j->periksa)
                        <a class="btn btn-primary btn-sm" href="/pasien/periksa/{{ $j->periksa->id }}">Periksa</a>
                    @else
                    <form action="/pasien/periksa" method="post">
                        @csrf
                        <input type="hidden" name="daftar_poli_id" value="{{ $j->id }}">

                        <button class="btn btn-primary btn-sm" type="submit">Periksa</button>
                    </form>
                    @endif
                </td>
                <td>
                    <form action="/pasien/daftar_poli/batal" method="post">

                        @csrf
                        @method('delete')

                        <input type="hidden" name="id" value="{{ $j->id }}">

                        <button class="btn btn-danger btn-sm" type="submit">Batal</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @endforeach
    </tbody>

  </table>

@endsection