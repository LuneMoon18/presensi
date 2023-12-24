<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_divisi');
        $query->join('divisi', 'karyawan.kode_divisi', '=', 'divisi.kode_divisi');
        $query->orderBy('nama_lengkap');

        if (!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }
        if (!empty($request->kode_divisi)) {
            $query->where('karyawan.kode_divisi', $request->kode_divisi);
        }
        $karyawan = $query->paginate(5);
        $divisi = DB::table('divisi')->get();

        return view('karyawan.index', compact('karyawan', 'divisi'));
    }

    public function store(Request $request)
    {
        $nip = $request->nip;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $kode_divisi = $request->kode_divisi;
        $no_hp = $request->no_hp;
        $password = Hash::make('12345');

        if ($request->hasFile('foto')) {
            $foto = $nip . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }
        try {
            $data = [
                'nip' => $nip,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'kode_divisi' => $kode_divisi,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password
            ];

            $save = DB::table('karyawan')->insert($data);
            if ($save) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/karyawan";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                $message = ". Data dengan Employee Code " . $nip . " sudah ada";
            }
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan' . $message]);
        }
    }
    public function edit(Request $request)
    {
        $nip = $request->nip;
        $divisi = DB::table('divisi')->get();
        $karyawan = DB::table('karyawan')
            ->where('nip', $nip)
            ->first();
        return view('karyawan.edit', compact('divisi', 'karyawan'));
    }
    public function update($nip, Request $request)
    {
        $nip = $request->nip;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $kode_divisi = $request->kode_divisi;
        $no_hp = $request->no_hp;
        $password = Hash::make('12345');
        $foto_lama = $request->foto_lama;
        if ($request->hasFile('foto')) {
            $foto = $nip . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $foto_lama;
        }
        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'kode_divisi' => $kode_divisi,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password
            ];

            $update = DB::table('karyawan')->where('nip', $nip)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/karyawan";
                    $folderPathOld = "public/uploads/karyawan/" . $foto_lama;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Diperbarui']);
            }
        } catch (\Exception $e) {
            Redirect::back()->with(['warning' => 'Data Gagal Diperbarui']);
        }
    }
    public function delete($nip)
    {
        $delete = DB::table('karyawan')->where('nip', $nip)->delete();
        if ($delete) {

            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}