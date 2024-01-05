<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PeriksaController extends Controller
{
    //
    public function daftarPoli(Request $request){
        

        $data_valid = $request->validate([
            'no_rm' => 'required',
            'jadwal_periksa_id' => 'required|numeric',
            'keluhan' => 'required',
        ]);

        $data_valid['pasien_id'] = Pasien::firstWhere('no_rm', $data_valid['no_rm'])->id;
        

        $no_antrian = DaftarPoli::where('jadwal_periksa_id', $data_valid['jadwal_periksa_id'])->get()->count();

        $data_valid['no_antrian'] = $no_antrian + 1;


        DaftarPoli::create($data_valid);


        return redirect()->back()->with('pesan', 'Anda sudah mendaftar ke klinik');

    }

    public function antrian(){
        
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dokter_id = Auth::guard('dokter')->user()->id;
        
        $jadwal = JadwalPeriksa::with(['daftar_poli', 'daftar_poli.pasien', 'daftar_poli.periksa'])->where('hari', $hari[now()->dayOfWeek])->where('dokter_id', $dokter_id)->get();

        //ddd($jadwal);

        return view('pages.periksa.pasien', [
            'jadwalGlobal' => $jadwal,
        ]);


    }

    public function mulai_periksa(Request $request){
        $data_valid = $request->validate([
            'daftar_poli_id' => 'required|numeric',
        ]);

        $periksa = Periksa::create($data_valid);

        return redirect(url('/pasien/periksa/'. $periksa->id));
    }


    public function periksa($id){
        
        $periksa = Periksa::with(['daftar_poli.pasien', 'daftar_poli', 'daftar_poli.jadwal_periksa', 'detail_periksa', 'detail_periksa.obat'])->find($id);

        $riwayat = DaftarPoli::with(['periksa', 'periksa.detail_periksa', 'periksa.detail_periksa'])->where('pasien_id', $periksa->daftar_poli->pasien->id)->get();

        //ddd($riwayat);
        $obat = Obat::all();
        

        return view('pages.periksa.detail', [
            'periksa' => $periksa,
            'obat' => $obat,
            'riwayat' => $riwayat,
        ]);
    }

    public function batal_periksa(Request $request){
        $data_valid = $request->validate([
            'id' => 'required|numeric',
        ]);

        DaftarPoli::destroy($data_valid['id']);

        return redirect()->back();
    }

    public function data_periksa(Request $request){
        
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'daftar_poli_id' => 'required|numeric',
            'tgl_periksa' => 'required',
            'catatan' => 'required',
        ]);

        $data_valid['tgl_periksa'] = Carbon::parse($data_valid['tgl_periksa']);

        Periksa::find($data_valid['id'])->update($data_valid);

        return redirect()->back()->with('pesan', 'Berhasil diupdate');

    }

    public function tambah_obat(Request $request){
        
        $data_valid = $request->validate([
            'obat_id' => 'required|numeric',
            'periksa_id' => 'required|numeric',
        ]);




        DetailPeriksa::create($data_valid);
        

        return redirect()->back()->with('pesan', 'Berhasil ditambahkan Obatnya!');
        
    }
    

    public function hapus_obat($id){
        
        DetailPeriksa::destroy($id);

        return redirect()->back()->with('pesan', 'Obat berhasil dihapus!');
    }

    public function biaya_periksa(Request $request){
        
        $data_valid = $request->validate([
            'periksa_id' => 'required|numeric',
        ]);

        $detail = DetailPeriksa::with('obat')->where('periksa_id', $data_valid['periksa_id'])->get();
        
        $biaya_obat = 0;

        foreach ($detail as $d) {
            $biaya_obat += $d->obat->harga;
        }

        $biaya_periksa = $biaya_obat + 150000;

        $data_valid['biaya_periksa'] = $biaya_periksa;

        Periksa::find($data_valid['periksa_id'])->update($data_valid);


        return redirect()->back()->with('pesan', 'Biaya Pengobatan berhasil dihitung');
        
    }
}
