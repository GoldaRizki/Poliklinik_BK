<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    //


    public function halamanLogin(){
        return view('pages.login.dokter');
    }

    public function login(Request $request){


        $data_valid = $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);


        if(Auth::guard('dokter')->attempt($data_valid)){
            $request->session()->regenerate();
 
            return redirect()->intended('/home');
        }else{
            return back()->withErrors(['login_gagal' => 'Username dan password tidak sesuai']);
        }

    }


    public function logout(Request $request)
    {
        Auth::guard('dokter')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function index(){
        
        $poli = Poli::all();
        $daftar_dokter = Dokter::all();

        return view('pages.dokter.index', [
            'link_form' => url('/dokter/create'),
            'method' => 'POST',
            'daftar_dokter' => $daftar_dokter,
            'poli' => $poli,
        ]);
    }

    public function edit($id){
            
        $poli = Poli::all();

        $daftar_dokter = Dokter::all();

        $dokter = Dokter::find($id);

        return view('pages.dokter.index', [
            'link_form' => url('/dokter/update'),
            'method' => 'PUT',
            'dokter' => $dokter,
            'daftar_dokter' => $daftar_dokter,
            'poli' => $poli,

        ]);


    }


    public function create(Request $request){
        $data_valid = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'password' => 'required',
            'poli_id' => 'required|numeric',
        ]);
        


        $data_valid['password'] = bcrypt($data_valid['password']);
        
        Dokter::create($data_valid);

        return redirect(url('/dokter'));
    }

    public function update(Request $request){
        
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'poli_id' => 'required|numeric',
            
        ]);


        Dokter::find($data_valid['id'])->update($data_valid);

        return redirect(url('/dokter'));
    }

    public function delete($id){
        

        Dokter::destroy($id);

        return redirect(url('/dokter'));
    }

}
