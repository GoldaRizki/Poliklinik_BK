<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    //

    public function index(){

        $dokter_id = Auth::guard('dokter')->user()->id;
        $jadwal = JadwalPeriksa::with('dokter')->where('dokter_id', $dokter_id)->get();


        return view('pages.jadwal.index', [
            'link_form' => url('/jadwal/create'),
            'method' => 'POST',
            'jadwal' => $jadwal,
        ]); 
    }

    public function create(Request $request){

        $data_valid = $request->validate([
            'dokter_id' => 'required|numeric',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',

        ]);

        //ddd(Carbon::parse($data_valid['jam_mulai']));
        $jam_input_mulai = Carbon::parse($data_valid['jam_mulai']);
        $jam_input_selesai = Carbon::parse($data_valid['jam_selesai']);
        $dokter = Dokter::find($data_valid['dokter_id']);

        if($jam_input_mulai->greaterThanOrEqualTo($jam_input_selesai)){
            return redirect()->back()->withErrors(['input_tidak_valid' => 'Input tidak valid! Pastikan inputan benar!'])->withInput();
        }

        $jadwal = JadwalPeriksa::with(['dokter'])->whereRelation('dokter', 'poli_id', $dokter->poli_id)->where('hari', $data_valid['hari'])->get();

    
        foreach ($jadwal as $j) {
            $jam_mulai = Carbon::parse($j->jam_mulai);
            $jam_selesai = Carbon::parse($j->jam_selesai);


            if(($jam_input_mulai->greaterThanOrEqualTo($jam_mulai) && $jam_input_mulai->lessThanOrEqualTo($jam_selesai)) || ($jam_input_selesai->greaterThanOrEqualTo($jam_mulai) && $jam_input_selesai->lessThanOrEqualTo($jam_selesai)) || ($jam_mulai->greaterThanOrEqualTo($jam_input_mulai) && $jam_mulai->lessThanOrEqualTo($jam_input_selesai)) || ($jam_selesai->greaterThanOrEqualTo($jam_input_mulai) && $jam_selesai->lessThanOrEqualTo($jam_input_selesai))){
                return redirect()->back()->withErrors(['jadwal_tabrakan' => 'jadwal bertabrakan! Silahkan cari jam yang lain!'])->withInput();
            }
        }

        $data_valid['Aktif'] = 'Y';

        JadwalPeriksa::create($data_valid);

        return redirect()->back();
        
    }

    public function edit($id){

        $jadwal = JadwalPeriksa::with('dokter')->get();

        $jadwalPeriksa = $jadwal->firstWhere('id', $id);

        return view('pages.jadwal.index', [
            'link_form' => url('/jadwal/update'),
            'method' => 'PUT',
            'jadwal' => $jadwal,
            'jadwalPeriksa' => $jadwalPeriksa,
        ]); 
    }

    public function update(Request $request){
        
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'dokter_id' => 'required|numeric',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);


        //ddd(Carbon::parse($data_valid['jam_mulai']));
        $jam_input_mulai = Carbon::parse($data_valid['jam_mulai']);
        $jam_input_selesai = Carbon::parse($data_valid['jam_selesai']);
        $dokter = Dokter::find($data_valid['dokter_id']);

        if($jam_input_mulai->greaterThanOrEqualTo($jam_input_selesai)){
            return redirect()->back()->withErrors(['input_tidak_valid' => 'Input tidak valid! Pastikan inputan benar!'])->withInput();
        }


        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        if($data_valid['hari'] == $hari[now(7)->dayOfWeek]){
            return redirect()->back()->withErrors(['jadwal_tabrakan' => 'jadwal sudah tidak bisa diubah pada hari H!'])->withInput();
        }


        $jadwal = JadwalPeriksa::with(['dokter'])->whereRelation('dokter', 'poli_id', $dokter->poli_id)->where('hari', $data_valid['hari'])->where('id', '!=' , $data_valid['id'])->get();
    
        foreach ($jadwal as $j) {
            $jam_mulai = Carbon::parse($j->jam_mulai);
            $jam_selesai = Carbon::parse($j->jam_selesai);


            if(($jam_input_mulai->greaterThanOrEqualTo($jam_mulai) && $jam_input_mulai->lessThanOrEqualTo($jam_selesai)) || ($jam_input_selesai->greaterThanOrEqualTo($jam_mulai) && $jam_input_selesai->lessThanOrEqualTo($jam_selesai)) || ($jam_mulai->greaterThanOrEqualTo($jam_input_mulai) && $jam_mulai->lessThanOrEqualTo($jam_input_selesai)) || ($jam_selesai->greaterThanOrEqualTo($jam_input_mulai) && $jam_selesai->lessThanOrEqualTo($jam_input_selesai))){
                return redirect()->back()->withErrors(['jadwal_tabrakan' => 'jadwal bertabrakan! Silahkan cari jam yang lain!'])->withInput();
            }
        }
    

        JadwalPeriksa::find($data_valid['id'])->update($data_valid);


        return redirect()->back();

    }

    public function delete($id){
        
        JadwalPeriksa::destroy($id);

        return redirect()->back();
    }


    public function jadwal_aktif($id){
        
        $jadwal = JadwalPeriksa::find($id);

        if($jadwal->Aktif == 'Y'){
            $jadwal->update(['Aktif' => 'N']);
        }elseif($jadwal->Aktif == 'N') {
            $jadwal->update(['Aktif' => 'Y']);
        }

        return redirect()->back();
    }
}
