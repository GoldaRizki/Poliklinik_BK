<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    //

    public function index(){
        
        $daftar_obat = Obat::all();

        return view('pages.obat.index', [
            'link_form' => url('/obat/create'),
            'method' => 'POST',
            'daftar_obat' => $daftar_obat
        ]);
    }

    public function edit($id){
            
        $daftar_obat = Obat::all();

        $obat = Obat::find($id);

        return view('pages.obat.index', [
            'link_form' => url('/obat/update'),
            'method' => 'PUT',
            'obat' => $obat,
            'daftar_obat' => $daftar_obat
        ]);


    }


    public function create(Request $request){
        
        $data_valid = $request->validate([
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required|numeric',
        ]);

        Obat::create($data_valid);

        return redirect(url('/obat'));
    }

    public function update(Request $request){
        
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'nama_obat' => 'required',
            'kemasan' => 'required',
            'harga' => 'required|numeric',
        ]);

        Obat::find($data_valid['id'])->update($data_valid);

        return redirect(url('/obat'));
    }

    public function delete($id){
        

        Obat::destroy($id);

        return redirect(url('/obat'));
    }

}
