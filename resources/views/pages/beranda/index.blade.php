@extends('layouts.header')


@section('isi')
    
    @if(Auth::guard('admin')->guest() && Auth::guard('dokter')->guest())
    <h2>Selamat Datang di Poliklinik</h2>
    @endif
    
    @auth('dokter')
        <h4> Halo! Dokter, {{ Auth::guard('dokter')->user()->nama }}</h4>
    @endauth

    @auth('admin')
    <h4> Halo! Admin, {{ Auth::guard('admin')->user()->nama }}</h4>
@endauth

@endsection