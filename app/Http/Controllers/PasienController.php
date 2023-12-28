<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PasienController extends Controller
{
    //

    public function halamanDaftar(){
        return view('pages.pasien.daftar');
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


        
    
    }
}
