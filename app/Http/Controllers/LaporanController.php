<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class LaporanController extends Controller
{
    public function laporanabsensi(Request $request)
    {
        $bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        $divisi = DB::table('divisi')->get();

        return view('laporan.laporanabsensi', compact('bulan', 'karyawan', 'divisi', 'namabulan'));
    }

    public function individu(Request $request)
    {
        $nip = $request->nip;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $karyawan = DB::table('karyawan')->where('nip', $nip)
            ->join('divisi', 'karyawan.kode_divisi', '=', 'divisi.kode_divisi')
            ->first();

        $presensi = DB::table('presensi')
            ->where('nip', $nip)
            ->whereRaw('MONTH(presence_date)="' . $bulan . '"')
            ->whereRaw('YEAR(presence_date)="' . $tahun . '"')
            ->orderBy('presence_date')
            ->get();

        if (isset($_POST['ekspor'])) {
            $time = date("d-m-Y H:i:s");
            //mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            //mendefinisikan nama file export
            header("Content-Disposition: attachment; filename= Laporan Absensi Karyawan $time.xls");
        }

        return view('laporan.individu', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'presensi'));
    }

    public function bulanan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
            ->selectRaw('presensi.nip, nama_lengkap, MAX(IF(DAY(presence_date)= 1, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_1,
                        MAX(IF(DAY(presence_date)= 2, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_2,
                        MAX(IF(DAY(presence_date)= 3, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_3,
                        MAX(IF(DAY(presence_date)= 4, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_4,
                        MAX(IF(DAY(presence_date)= 5, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_5,
                        MAX(IF(DAY(presence_date)= 6, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_6,
                        MAX(IF(DAY(presence_date)= 7, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_7,
                        MAX(IF(DAY(presence_date)= 8, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_8,
                        MAX(IF(DAY(presence_date)= 9, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_9,
                        MAX(IF(DAY(presence_date)= 10, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_10,
                        MAX(IF(DAY(presence_date)= 11, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_11,
                        MAX(IF(DAY(presence_date)= 12, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_12,
                        MAX(IF(DAY(presence_date)= 13, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_13,
                        MAX(IF(DAY(presence_date)= 14, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_14,
                        MAX(IF(DAY(presence_date)= 15, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_15,
                        MAX(IF(DAY(presence_date)= 16, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_16,
                        MAX(IF(DAY(presence_date)= 17, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_17,
                        MAX(IF(DAY(presence_date)= 18, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_18,
                        MAX(IF(DAY(presence_date)= 19, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_19,
                        MAX(IF(DAY(presence_date)= 20, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_20,
                        MAX(IF(DAY(presence_date)= 21, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_21,
                        MAX(IF(DAY(presence_date)= 22, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_22,
                        MAX(IF(DAY(presence_date)= 23, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_23,
                        MAX(IF(DAY(presence_date)= 24, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_24,
                        MAX(IF(DAY(presence_date)= 25, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_25,
                        MAX(IF(DAY(presence_date)= 26, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_26,
                        MAX(IF(DAY(presence_date)= 27, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_27,
                        MAX(IF(DAY(presence_date)= 28, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_28,
                        MAX(IF(DAY(presence_date)= 29, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_29,
                        MAX(IF(DAY(presence_date)= 30, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_30,
                        MAX(IF(DAY(presence_date)= 31, CONCAT(time_in, "-", IFNULL(time_out,"00:00:00")),"")) as tgl_31')
            ->join('karyawan', 'presensi.nip', '=', 'karyawan.nip')
            ->whereRaw('MONTH(presence_date)="' . $bulan . '"')
            ->whereRaw('YEAR(presence_date)="' . $tahun . '"')
            ->groupByRaw('presensi.nip, nama_lengkap')
            ->get();

        if (isset($_POST['ekspor'])) {
            $time = date("d-m-Y H:i:s");
            //mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            //mendefinisikan nama file export
            header("Content-Disposition: attachment; filename=Rekap Absensi Karyawan $time.xls");
        }

        return view('laporan.bulanan', compact('bulan', 'tahun', 'rekap', 'namabulan'));
    }
}
