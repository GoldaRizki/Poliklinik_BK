<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PasienController extends Controller
{
    //

    public function halamanDaftar(){

        $jadwal = JadwalPeriksa::all();




        return view('pages.pasien.daftar', [
            'jadwal' => $jadwal,
        ]);
    }

    public function daftar(Request $request){
        $data_valid = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric',
            'no_hp' => 'required|numeric',
        ]);


        $cari = Pasien::where('no_ktp', $data_valid['no_ktp'])->get()->isEmpty();

        if($cari){
            $hari_ini = now(7);
            $terdaftar = Pasien::whereDate('created_at', $hari_ini)->get();

            $jumlah = $terdaftar->count() + 1;

            $urutan = '';
            if($jumlah < 10){
                $urutan = '00';
            }elseif ($jumlah < 100) {
                $urutan = '0';
            }

            $urutan .= $jumlah;

            $no_rekam_medis = $hari_ini->format('Ym') . '-' . $urutan;

            $data_valid['no_rm'] = $no_rekam_medis;

            Pasien::create($data_valid);

            return redirect(url('/daftarpoli'))->with('no_rekam_medis', $no_rekam_medis);
        }else{
            return redirect()->back()->withErrors(['telah_terdaftar' => 'Data sudah didaftarkan']);

        }

        return redirect()->back()->with('pesan', 'Anda berhasil terdaftar!');

    }


    public function index(){
        $daftar_pasien = Pasien::all();

        return view('pages.pasien.list', [
            'daftar_pasien' => $daftar_pasien,
            'link_form' => '/pasien/create',
            'method' => 'post'
        ]);
    }

    public function create(Request $request){
        $data_valid = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'no_rm' => 'required',
        ]);


        Pasien::create($data_valid);

        return redirect()->back()->with('pesan', 'Pasien berhasil ditambahkan!');
    }

    public function edit($id){
        $daftar_pasien = Pasien::all();

        $pasien = Pasien::find($id);

        return view('pages.pasien.list', [
            'pasien' => $pasien,
            'daftar_pasien' => $daftar_pasien,
            'link_form' => '/pasien/update',
            'method' => 'PUT'
        ]);

    }

    public function update(Request $request){
        
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'no_ktp' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'no_rm' => 'required',
        ]);


        Pasien::find($data_valid['id'])->update($data_valid);

        return redirect()->back()->with('pesan', 'Pasien berhasil diedit!');
    }

    
    public function delete($id){
        
        Pasien::destroy($id);

        return redirect()->back()->with('pesan', 'Pasien berhasil Dihapus!');
    }

}
