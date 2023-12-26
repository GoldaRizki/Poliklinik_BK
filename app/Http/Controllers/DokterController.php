<?php

namespace App\Http\Controllers;

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
}
