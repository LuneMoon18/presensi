@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Laporan Absensi
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/presensi/cetaklaporan" id="formlaporan" target="blank" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="bulan" id="bulan" class="form-select">
                                            <option value="">Bulan</option>
                                            @for($i= 1; $i <= 12; $i++) <option value="{{$i}}" {{date("m")==$i
                                                ? 'selected' : '' }}>{{$bulan[$i]}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="tahun" id="tahun" class="form-select">
                                            <option value="">Tahun</option>
                                            @php
                                            $startingyear = 2022;
                                            $currentyear = date("Y");
                                            @endphp
                                            @for ($year= $startingyear; $year <= $currentyear; $year++) <option
                                                value="{{$year}}" {{date("Y")==$year ? 'selected' : '' }}>{{$year}}
                                                </option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="nip" id="nip" class="form-select">
                                            <option value="">Pilih Karyawan</option>
                                            @foreach ($karyawan as $d)
                                            <option value="{{$d->nip}}">{{$d->nama_lengkap}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" name="cetak" class="btn btn-primary w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-printer" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                <path
                                                    d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                            </svg>
                                            Cetak
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" name="ekspor" class="btn btn-primary w-100">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-printer" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                                <path
                                                    d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                            </svg>
                                            Ekspor ke Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(function () {
        $("#formlaporan").submit(function (e) {
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            var nip = $("#nip").val();
            if (bulan == "") {
                Swal.fire({
                    title: 'warning!',
                    text: 'Bulan harus dipilih',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $('#bulan').focus();
                });
                return false;
            } else if (tahun == "") {
                Swal.fire({
                    title: 'warning!',
                    text: 'Tahun harus dipilih',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $('#tahun').focus();
                });
                return false;
            }
            else if (nip == "") {
                Swal.fire({
                    title: 'warning!',
                    text: 'Pilih nama karyawannya',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $('#nip').focus();
                });
                return false;
            }
        });
    });
</script>
@endpush