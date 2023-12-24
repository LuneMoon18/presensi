@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#absenhariini">
                                    <span class="text-white avatar"
                                        style="background-color: #FDB827; color: #F1F1F1;"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-users" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div class="col">
                        <div class="font-weight-medium">
                            {{$rekapabsen->jmlhadir}}
                        </div>
                        <div class="text-secondary">
                            <b>Kehadiran</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#terlambathariini">
                                    <span class="text-white avatar"
                                        style="background-color: #FDB827; color: #F1F1F1;"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-hourglass-high" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M6.5 7h11" />
                                            <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                                            <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div class="col">
                        <div class="font-weight-medium">
                            {{$rekapabsen->jmlterlambat != null ? $rekapabsen-> jmlterlambat: 0}}
                        </div>
                        <div class="text-secondary">
                            <b>Terlambat</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#izinhariini">
                                    <span class="text-white avatar"
                                        style="background-color: #FDB827; color: #F1F1F1;"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M16 3l0 4" />
                                            <path d="M8 3l0 4" />
                                            <path d="M4 11l16 0" />
                                            <path d="M8 15h2v2h-2z" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div class="col">
                        <div class="font-weight-medium">
                            {{$rekapizin->jmlizin != null ? $rekapizin-> jmlizin : 0}}
                        </div>
                        <div class="text-secondary">
                            <b>Izin</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#sakithariini">
                                    <span class="text-white avatar"
                                        style="background-color: #FDB827; color: #F1F1F1;"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-medicine-syrup" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M8 21h8a1 1 0 0 0 1 -1v-10a3 3 0 0 0 -3 -3h-4a3 3 0 0 0 -3 3v10a1 1 0 0 0 1 1z" />
                                            <path d="M10 14h4" />
                                            <path d="M12 12v4" />
                                            <path d="M10 7v-3a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div class="col">
                        <div class="font-weight-medium">
                            {{$rekapizin->jmlsakit != null ? $rekapizin-> jmlsakit : 0}}
                        </div>
                        <div class="text-secondary">
                            <b>Sakit</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;" id="absenhariini">
            <div class="col-12">
                <div class="col">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Absensi hari ini
                        </h3>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Code</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jam Masuk</th>
                                            <th>keterangan</th>
                                            <th>Jam Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jmlabsen as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d->nip}}</td>
                                            <td>{{$d->nama_lengkap}}</td>
                                            <td>{{$d->time_in}}</td>
                                            <td>
                                                @if($d->time_in>'07.00')
                                                Terlambat
                                                @else
                                                Tepat Waktu
                                                @endif
                                            </td>
                                            <td>
                                                {{$d->time_out != null ? $d->time_out : 'Belum Absen'}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$jmlabsen-> links('')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;" id="terlambathariini">
            <div class="col-12">
                <div class="col">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Absensi Terlambat
                        </h3>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Code</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jam Masuk</th>
                                            <th>keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jmlterlambat as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d->nip}}</td>
                                            <td>{{$d->nama_lengkap}}</td>
                                            <td>{{$d->time_in}}</td>
                                            <td>@if($d->time_in>'07.00')
                                                Terlambat
                                                @else
                                                Tepat Waktu
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$jmlterlambat-> links('')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;" id="izinhariini">
            <div class="col-12">
                <div class="col">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Izin hari ini
                        </h3>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Code</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($izin as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d->nip}}</td>
                                            <td>{{$d->nama_lengkap}}</td>
                                            <td>{{$d->jabatan}}</td>
                                            <td>{{$d->status}}</td>
                                            <td>{{$d->keterangan}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$izin-> links('')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;" id="sakithariini">
            <div class="col-12">
                <div class="col">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Karyawan Sakit
                        </h3>
                    </div>
                </div>
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Code</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sakit as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d->nip}}</td>
                                            <td>{{$d->nama_lengkap}}</td>
                                            <td>{{$d->jabatan}}</td>
                                            <td>{{$d->status}}</td>
                                            <td>{{$d->keterangan}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$sakit-> links('')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection