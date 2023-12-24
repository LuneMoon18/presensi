<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create()
    {
        //karyawan sudah absen atau belum
        $harini = date("Y-m-d");
        $nip = Auth::guard('karyawan')->user()->nip;
        $cek = DB::table('presensi')->where('presence_date', $harini)->where('nip', $nip)->count();
        return view('presensi.create', compact('cek'));
    }
    public function store(Request $request)
    {
        $nip = Auth::guard('karyawan')->user()->nip;
        $presence_date = date("Y-m-d");
        $jam = date("H:i:s");
        $latitudekantor = -6.9173248;
        $longitudekantor = 107.610112;
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];


        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["distance"]);

        $cek = DB::table('presensi')->where('presence_date', $presence_date)->where('nip', $nip)->count();
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        $cek = DB::table('presensi')->where('presence_date', $presence_date)->where('nip', $nip)->count();
        if ($radius > 5) {
            echo "error|Diluar radius, jarak anda " . $radius . " meter dari kantor|radius";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'time_out' => $jam,
                    'lat_long' => $lokasi,
                ];
                $update = DB::table('presensi')->where('presence_date', $presence_date)->where('nip', $nip)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih dan hati-hati dijalannya|out";
                } else {
                    echo "error!Gagal absen|out";
                }
            } else {
                //simpan data ke database
                $data = [
                    'nip' => $nip,
                    'presence_date' => $presence_date,
                    'time_in' => $jam,
                    'lat_long' => $lokasi,
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success| Terimakasih dan selamat bekerja|in";
                } else {
                    echo "error!Gagal absen|in";
                }
            }
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Radius bumi dalam meter

        $theta = $lon1 - $lon2;
        $distance = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;

        $distance *= 5280; // Konversi ke kaki
        $distance /= 3; // Konversi ke yard
        $distance *= 1.609344; // Konversi ke kilometer
        $distance *= 1000; // Konversi ke meter

        return compact('distance');
    }


    public function editprofil()
    {
        $nip = Auth::guard('karyawan')->user()->nip;
        $karyawan = DB::table('karyawan')
            ->where('nip', $nip)
            ->first();
        return view('presensi.editprofil', compact('karyawan'));
    }
    public function updateprofil(Request $request)
    {
        $nip = Auth::guard('karyawan')->user()->nip;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nip', $nip)->first();

        if ($request->hasFile('foto')) {
            $foto = $nip . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        if (empty($request->password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
        }

        $update = DB::table('karyawan')->where('nip', $nip)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/karyawan/";
                // Pastikan folder sudah ada dan memiliki izin tulis
                if (!is_dir(storage_path($folderPath))) {
                    mkdir(storage_path($folderPath), 0777, true);
                }

                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Terupdate']);
        } else {
            return Redirect::back()->with(['error' => 'Gagal Update']);
        }
    }
    public function riwayat()
    {
        $bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('presensi.riwayat', compact('bulan'));
    }
    public function getriwayat(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $nip = Auth::guard('karyawan')->user()->nip;

        $riwayat = DB::table('presensi')
            ->whereRaw('MONTH(presence_date)="' . $month . '"')
            ->whereRaw('YEAR(presence_date)="' . $year . '"')
            ->where('nip', $nip)
            ->orderBy('presence_date')
            ->get();

        return view('presensi.getriwayat', compact('riwayat'));
    }
    public function izin()
    {
        $nip = Auth::guard('karyawan')->user()->nip;
        $dataizin = DB::table('permission')->where('nip', $nip)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function pengajuanizin()
    {
        return view('presensi.pengajuanizin');
    }
    public function storeizin(Request $request)
    {
        $nip = Auth::guard('karyawan')->user()->nip;
        $tanggal_izin = $request->tanggal_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nip' => $nip,
            'permission_date' => $tanggal_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $save = DB::table('permission')->insert($data);
        if ($save) {
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tgl = $request->tgl;
        $absen = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap', 'nama_divisi')
            ->join('karyawan', 'presensi.nip', '=', 'karyawan.nip')
            ->join('divisi', 'karyawan.kode_divisi', '=', 'divisi.kode_divisi')
            ->where('presensi.presence_date', $tgl)
            ->get();

        return view('presensi.getpresensi', compact('absen'));
    }

    //laporan absensi
    public function laporanabsen()
    {
        $bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('bulan', 'karyawan'));
    }

    public function cetaklaporan(Request $request)
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

        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'presensi'));
    }
    public function rekap(Request $request)
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.rekap', compact('namabulan'));
    }

    public function cetakrekap(Request $request)
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

        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'rekap', 'namabulan'));
    }

    public function laporanabsensi()
    {
        return view('presensi.laporanabsensi');
    }

    public function mohonizin(Request $request)
    {
        $query = Permission::query();
        $query->select('id', 'permission.nip', 'permission_date', 'nama_lengkap', 'jabatan', 'status', 'status_approval', 'keterangan');
        $query->join('karyawan', 'permission.nip', "=", 'karyawan.nip');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('permission_date', [$request->dari, $request->sampai]);
        }

        if (!empty($request->nip)) {
            $query->where('permissiion.nip', $request->nip);
        }

        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if ($request->status_approval === '0' || $request->status_approval === '1' || $request->status_approval === '2') {
            $query->where('status_approval', $request->status_approval);
        }

        $query->orderBy('permission_date', 'desc');
        $mohonizin = $query->paginate(2);
        $mohonizin->appends($request->all());
        return view('presensi.mohonizin', compact('mohonizin'));
    }

    public function statusapproval(Request $request)
    {
        $statusapproval = $request->status_app;
        $id_mohonizinform = $request->id_mohonizinform;
        $simpan = DB::table('permission')->where('id', $id_mohonizinform)->update([
            'status_approval' => $statusapproval
        ]);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Status Diperbarui']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Gagal Diperbarui']);
        }
    }
    public function cancelizin($id)
    {
        $simpan = DB::table('permission')->where('id', $id)->update([
            'status_approval' => 0
        ]);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Dibatalkan']);
        } else {
            return Redirect::back()->with(['warning' => 'Gagal Dibatalkan']);
        }
    }

    public function cekpengajuanizin(Request $request)
    {
        $tanggal_izin = $request->tanggal_izin;
        $nip = Auth::guard('karyawan')->user()->nip;

        $cek = DB::table('permission')->where('nip', $nip)->where('permission_date', $tanggal_izin)->count();
        return $cek;

    }
}