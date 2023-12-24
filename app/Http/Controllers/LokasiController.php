<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use PHPUnit\Event\Test\AfterLastTestMethodCalled;

class LokasiController extends Controller
{
    public function lokasi(Request $request)
    {
        $query = Perusahaan::query();
        $query->select('*');
        $lokasi = $query->first();
        return view('lokasi.lokasi', compact('lokasi'));
    }
    public function editlokasi(Request $request)
    {
        $query = Perusahaan::query();
        $query->select('*');
        $perusahaan = $query->first();
        return view('lokasi.edit', compact('perusahaan'));
    }
    public function updatelokasi($kode_pos, Request $request)
    {
        $alamat = $request->alamat;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius;

        try {
            $data = [
                'alamat' => $alamat,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'radius' => $radius
            ];

            $update = DB::table('perusahaan')->where('kode_pos', $kode_pos)->update($data);

            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diperbarui']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diperbarui']);
        }
    }

}
