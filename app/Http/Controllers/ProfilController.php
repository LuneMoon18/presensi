<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProfilController extends Controller
{
    public function profil(Request $request)
    {
        $query = Profil::query();
        $query->select('*');
        $profil = $query->first();
        return view('profil.index', compact('profil'));
    }
    public function editprofil(Request $request)
    {
        $query = Profil::query();
        $query->select('*');
        $profil = $query->first();
        return view('profil.edit', compact('profil'));
    }
    public function updateprofil($kode_pos, Request $request)
    {
        $kode_pos = $request->kode_pos;
        $nama_web = $request->nama_web;
        $deskrispi = $request->deskripsi;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;
        $alamat_web = $request->alamat_web;
        $nama_perusahaan = $request->nama_perusahaan;
        $nama_direktur = $request->nama_direktur;
        $nama_manager = $request->nama_manager;

        try {
            $data = [
                'nama_web' => $nama_web,
                'deskripsi' => $deskrispi,
                'no_hp' => $no_hp,
                'alamat' => $alamat,
                'alamat_web' => $alamat_web,
                'nama_perusahaan' => $nama_perusahaan,
                'nama_direktur' => $nama_direktur,
                'nama_manager' => $nama_manager

            ];
            $update = DB::table('profil')->where('kode_pos', $kode_pos)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diperbarui']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diperbarui']);
        }
    }
}
