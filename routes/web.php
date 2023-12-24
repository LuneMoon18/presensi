<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//login karyawan
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});
//loginadmin
Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

//Register karyawan
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/aksi', [RegisterController::class, 'aksiregister'])->name('aksiregister');
//Registrasi admin
Route::get('registeradmin', [RegisterController::class, 'registeradmin'])->name('registeradmin');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');

//Lupa Password
Route::get('lupapassword', [PasswordController::class, 'lupapassword'])->name('lupapassword');
Route::post('lupapassword/perbarui', [PasswordController::class, 'perbaruipassword'])->name('perbaruipassword');
Route::get('/forgetpassword', [PasswordController::class, 'forgetpassword'])->name('forgetpassword');
Route::post('/forgetpassword/updatepassword', [PasswordController::class, 'updatepassword'])->name('updatepassword');

Route::middleware(['auth:karyawan'])->group(function () {
    //karyawan
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //editprofil
    Route::get('/editprofil', [PresensiController::class, 'editprofil']);
    Route::post('/presensi/{nik}/updateprofil', [PresensiController::class, 'updateprofil']);

    //riwayat
    Route::get('/presensi/riwayat', [PresensiController::class, 'riwayat']);
    Route::post('/getriwayat', [PresensiController::class, 'getriwayat']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/pengajuanizin', [PresensiController::class, 'pengajuanizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);
});

//admin
Route::middleware(['auth:user'])->group(function () {
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);
    Route::get('/karyawan', [KaryawanController::class, 'index']);

    //Karyawan
    Route::get('karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);

    //divisi
    Route::get('divisi', [DivisiController::class, 'index']);
    Route::post('/divisi/store', [DivisiController::class, 'store']);
    Route::post('/divisi/edit', [DivisiController::class, 'edit']);
    Route::post('/divisi/{kode_divisi}/update', [DivisiController::class, 'update']);
    Route::post('/divisi/{kode_divisi}/delete', [DivisiController::class, 'delete']);

    //monitoring
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::get('/presensi/laporanabsen', [PresensiController::class, 'laporanabsen']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);

    //laporanabsensi
    Route::get('/laporan/laporanabsensi', [LaporanController::class, 'laporanabsensi']);
    Route::post('/laporan/individu', [LaporanController::class, 'individu']);
    Route::post('/laporan/bulanan', [LaporanController::class, 'bulanan']);

    //mohon izin
    Route::get('/presensi/mohonizin', [PresensiController::class, 'mohonizin']);
    Route::post('/presensi/statusapproval', [PresensiController::class, 'statusapproval']);
    Route::get('/presensi/{id}/cancelizin', [PresensiController::class, 'cancelizin']);

    //profil
    Route::get('/profil', [ProfilController::class, 'profil']);
    Route::post('/profil/editprofil', [ProfilController::class, 'editprofil']);
    Route::post('/profil/{kode_pos}/updateprofil', [ProfilController::class, 'updateprofil']);

    //admin
    Route::get('/admin/profil', [AdminController::class, 'profil']);
    Route::post('/admin/edit', [AdminController::class, 'edit']);
    Route::post('/admin/update', [AdminController::class, 'update'])->name('update');


    //lokasi
    Route::get('/lokasi', [LokasiController::class, 'lokasi']);
    Route::post('/lokasi/editlokasi', [LokasiController::class, 'editlokasi']);
    Route::post('/lokasi/{kode_pos}/updatelokasi', [LokasiController::class, 'updatelokasi']);
});