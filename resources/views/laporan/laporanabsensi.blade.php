@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Laporan Absensi Individu
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/laporan/individu" id="formlaporan" target="blank" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="bulan" id="bulan" class="form-select">
                                            <option value="">Bulan</option>
                                            @for($i= 1; $i <= 12; $i++) <option value="{{$i}}" {{date("m")==$i
                                                ? 'selected' : '' }}>{{$bulan[$i]}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
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
                                        <button type="submit" name="cetak" class="btn w-100"
                                            style="background-color: #FDB827; color: #F1F1F1;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M20.2 20.2l1.8 1.8" />
                                            </svg>
                                            Preview
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" name="ekspor" class="btn w-100"
                                            style="background-color: #FDB827; color: #F1F1F1;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-file-spreadsheet" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M8 11h8v7h-8z" />
                                                <path d="M8 15h8" />
                                                <path d="M11 11v7" />
                                            </svg>
                                            Export Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-12">
                <div class="col">
                    <div class="box-header with-border">
                        <h2 class="box-title">
                            Laporan Absensi Bulanan
                        </h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="/laporan/bulanan" target="blank" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="bulan" id="bulan" class="form-select">
                                            <option value="">Bulan</option>
                                            @for($i= 1; $i <= 12; $i++) <option value="{{$i}}" {{date("m")==$i
                                                ? 'selected' : '' }}>{{$namabulan[$i]}}</option>
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
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" name="cetak" class="btn w-100"
                                            style="background-color: #FDB827; color: #F1F1F1;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M20.2 20.2l1.8 1.8" />
                                            </svg>
                                            Preview
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" name="ekspor" class="btn w-100"
                                            style="background-color: #FDB827; color: #F1F1F1;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-file-spreadsheet" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M8 11h8v7h-8z" />
                                                <path d="M8 15h8" />
                                                <path d="M11 11v7" />
                                            </svg>
                                            Eksport Excel
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