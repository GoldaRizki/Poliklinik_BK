<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function halamanLogin(){
        return view('pages.login.admin');
    }

    public function login(Request $request){


        $data_valid = $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);


        if(Auth::guard('admin')->attempt($data_valid)){
            $request->session()->regenerate();
 
            return redirect()->intended('/home');
        }else{
            return back()->withErrors(['login_gagal' => 'Username dan password tidak sesuai']);
        }

    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
