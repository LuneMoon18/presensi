<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DivisiController extends Controller
{
    public function index(Request $request)
    {
        $nama_divisi = $request->nama_divisi;
        $query = Divisi::query();
        $query->select('*');
        if (!empty($nama_divisi)) {
            $query->where('nama_divisi', 'like', '%' . $nama_divisi . '%');
        }
        $divisi = $query->paginate(5);

        return view('divisi.index', compact('divisi'));
    }
    public function store(Request $request)
    {
        $kode_divisi = $request->divisi_code;
        $nama_divisi = $request->divisi_name;
        $data = [
            'kode_divisi' => $kode_divisi,
            'nama_divisi' => $nama_divisi
        ];

        $cek = DB::table('divisi')->where('kode_divisi', $kode_divisi)->count();
        if ($cek > 0) {
            return Redirect::back()->with(['warning' => 'Data dengan Kode Divisi ' . $kode_divisi . " Sudah Ada"]);
        }

        $simpan = DB::table('divisi')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Divisi Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Divisi Gagal Disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $kode_divisi = $request->kode_divisi;
        $divisi = DB::table('divisi')
            ->where('kode_divisi', $kode_divisi)
            ->first();
        return view('divisi.edit', compact('divisi'));
    }
    public function update($kode_divisi, Request $request)
    {
        $new_kode_divisi = $request->kode_divisi;
        $nama_divisi = $request->nama_divisi;

        $data = [
            'kode_divisi' => $new_kode_divisi,
            'nama_divisi' => $nama_divisi
        ];

        $update = DB::table('divisi')->where('kode_divisi', $kode_divisi)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data Divisi Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Divisi Gagal Di Update']);
        }
    }

    public function delete($kode_divisi)
    {
        $delete = DB::table('divisi')->where('kode_divisi', $kode_divisi)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Divisi Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Divisi Gagal Di Hapus']);
        }
    }
}
