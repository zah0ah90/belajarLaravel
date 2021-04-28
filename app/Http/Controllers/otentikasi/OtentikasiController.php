<?php

namespace App\Http\Controllers\otentikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OtentikasiController extends Controller
{
    function index()
    {
        return view('otentikasi.login');
    }

    function login(Request $request)
    {
        // dd($request->all());
        // $data = User::where('email', $request->email)->firstOrFail();
        // // dd($data->email);
        // if ($data) {
        //     if (Hash::check($request->password, $data->password)) {
        //         session([
        //             'berhasil_login' => true
        //         ]);
        //         return redirect('/dashboard');
        //     }
        // }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        }
        return redirect('/')->with('message', 'password atau email salah boz');
    }

    function logout(Request $request)
    {
        // $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}