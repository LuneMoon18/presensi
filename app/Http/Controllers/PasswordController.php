<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PasswordController extends Controller
{
    //update password admin
    public function lupapassword(Request $request)
    {
        return view('auth.passwordadmin');
    }
    public function perbaruipassword(Request $request)
    {
        $email = $request->email;
        $password = Hash::make($request->password);
        $update = DB::table('users')->where('email', $email)->update(['password' => $password]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Password berhasil diperbarui. Silakan login menggunakan password yang baru']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Tidak Boleh Kosong']);
        }
    }

    //update password karyawan
    public function forgetpassword(Request $request)
    {
        return view('auth.passwordkaryawan');
    }
    public function updatepassword(Request $request)
    {
        $nip = $request->nip;
        $password = Hash::make($request->password);
        $update = DB::table('karyawan')->where('nip', $nip)->update(['password' => $password]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Password berhasil diperbarui. Silakan login menggunakan password yang baru']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Tidak Boleh Kosong']);
        }
    }
}