<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date("Y-m-d");
        $thismonth = date("m") * 1;
        $thisyear = date("Y");
        $nip = Auth::guard('karyawan')->user()->nip;

        $presensitoday = DB::table('presensi')
            ->where('nip', $nip)
            ->where('presence_date', $today)
            ->first();

        $historythismonth = DB::table('presensi')
            ->where('nip', $nip)
            ->whereRaw('MONTH(presence_date) = "' . $thismonth . '"')
            ->whereRaw('YEAR(presence_date) = "' . $thisyear . '"')
            ->orderBy('presence_date')
            ->get();

        $rekapabsen = DB::table('presensi')
            ->selectRaw('COUNT(nip) as jmlhadir, SUM(IF(time_in > "07:15", 1, 0)) as jmlterlambat')
            ->where('nip', $nip)
            ->whereYear('presence_date', $thisyear)
            ->whereMonth('presence_date', $thismonth)
            ->first();

        $leaderboard = DB::table('presensi')
            //join table
            ->join('karyawan', 'presensi.nip', '=', 'karyawan.nip')
            ->where('presensi.presence_date', $today)
            ->orderBy('time_in')
            ->get();

        $bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $rekapizin = DB::table('permission')
            ->selectRaw('SUM(IF(status = "i", 1, 0)) as jmlizin, SUM(IF(status = "s", 1, 0)) as jmlsakit')
            ->where('nip', $nip)
            ->whereRaw('MONTH(permission_date) = "' . $thismonth . '"')
            ->whereRaw('YEAR(permission_date) = "' . $thisyear . '"')
            ->where('status_approval', 1)
            ->first();

        return view('dashboard.dashboard', compact('presensitoday', 'historythismonth', 'bulan', 'thismonth', 'thisyear', 'rekapabsen', 'leaderboard', 'rekapizin'));
    }
    public function dashboardadmin(Request $request)
    {
        $today = date("Y-m-d");

        $rekapabsen = DB::table('presensi')
            ->selectRaw('COUNT(nip) as jmlhadir, SUM(IF(time_in > "07:15", 1, 0)) as jmlterlambat')
            ->where('presence_date', $today)
            ->first();

        $rekapizin = DB::table('permission')
            ->selectRaw('SUM(IF(status = "i", 1, 0)) as jmlizin, SUM(IF(status = "s", 1, 0)) as jmlsakit')
            ->where('permission_date', $today)
            ->where('status_approval', 1)
            ->first();

        $jmlabsen = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap')
            ->join('karyawan', 'presensi.nip', '=', 'karyawan.nip')
            ->where('presence_date', $today)
            ->paginate(5);

        $jmlterlambat = DB::table('presensi')
            ->select('karyawan.nama_lengkap', 'presensi.nip', 'presensi.time_in')
            ->join('karyawan', 'presensi.nip', '=', 'karyawan.nip')
            ->where('presensi.time_in', '>', '07:15')
            ->where('presence_date', $today)
            ->paginate(5);

        $izin = DB::table('permission')
            ->select('permission.*', 'nama_lengkap', 'jabatan')
            ->join('karyawan', 'permission.nip', '=', 'karyawan.nip')
            ->where('permission_date', $today)
            ->where('status', 'i')
            ->where('status_approval', 1)
            ->paginate(5);

        $sakit = DB::table('permission')
            ->select('permission.*', 'nama_lengkap', 'jabatan')
            ->join('karyawan', 'permission.nip', '=', 'karyawan.nip')
            ->where('permission_date', $today)
            ->where('status', 's')
            ->where('status_approval', 1)
            ->paginate(5);

        return view('dashboard.dashboardadmin', compact('rekapabsen', 'rekapizin', 'jmlabsen', 'jmlterlambat', 'izin', 'sakit'));
    }
}