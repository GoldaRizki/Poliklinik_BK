<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    //

    public function index(){
        
        $daftar_poli = Poli::all();

        return view('pages.poli.index', [
            'link_form' => url('/poli/create'),
            'method' => 'POST',
            'daftar_poli' => $daftar_poli
        ]);
    }

    public function edit($id){
            
        $daftar_poli = Poli::all();

        $poli = Poli::find($id);

        return view('pages.poli.index', [
            'link_form' => url('/poli/update'),
            'method' => 'PUT',
            'poli' => $poli,
            'daftar_poli' => $daftar_poli
        ]);


    }


    public function create(Request $request){
        
        $data_valid = $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'nullable',
        ]);

        Poli::create($data_valid);

        return redirect(url('/poli'));
    }

    public function update(Request $request){
        
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'nama_poli' => 'required',
            'keterangan' => 'nullable',
        ]);

        Poli::find($data_valid['id'])->update($data_valid);

        return redirect(url('/poli'));
    }

    public function delete($id){
        

        Poli::destroy($id);

        return redirect(url('/poli'));
    }
}
