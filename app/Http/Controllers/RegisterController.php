<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    //register admin
    public function registeradmin()
    {
        return view('auth.registeradmin');
    }

    public function actionregister(Request $request)
    {
        // Pemeriksaan input kosong
        if ($request->email == "" || $request->name == "" || $request->password == "") {
            return Redirect::back()->with(['warning' => 'Data Tidak Boleh Kosong']);
        }

        // Buat user jika input tidak kosong
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return Redirect::back()->with(['success' => 'Anda berhasil melakukan register, silakan login']);
    }

    //register karyawan
    public function register()
    {
        return view('auth.register');
    }
    public function aksiregister(Request $request)
    {
        // Pemeriksaan input kosong
        if ($request->nip == "" || $request->nama_lengkap == "" || $request->jabatan == "" || $request->no_hp == "" || $request->password == "") {
            return Redirect::back()->with(['warning' => 'Data Tidak Boleh Kosong']);
        }

        // Buat user jika input tidak kosong
        $karyawan = Karyawan::create([
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'kode_divisi' => $request->kode_divisi,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);
        return Redirect::back()->with(['success' => 'Anda berhasil melakukan register, silakan login']);
    }
}
