@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Data Permohonan Izin
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <form action="/presensi/mohonizin" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M7 14h.013" />
                                        <path d="M10.01 14h.005" />
                                        <path d="M13.01 14h.005" />
                                        <path d="M16.015 14h.005" />
                                        <path d="M13.015 17h.005" />
                                        <path d="M7.01 17h.005" />
                                        <path d="M10.01 17h.005" />
                                    </svg>
                                </span>
                                <input type="text" value="{{Request('dari')}}" class="form-control" name="dari"
                                    id="dari" placeholder="Pengajuan Dari Tanggal">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M7 14h.013" />
                                        <path d="M10.01 14h.005" />
                                        <path d="M13.01 14h.005" />
                                        <path d="M16.015 14h.005" />
                                        <path d="M13.015 17h.005" />
                                        <path d="M7.01 17h.005" />
                                        <path d="M10.01 17h.005" />
                                    </svg>
                                </span>
                                <input type="text" value="{{Request('sampai')}}" class="form-control" name="sampai"
                                    id="sampai" placeholder="Pengajuan Sampai Tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                </span>
                                <input type="text" value="{{Request('nama_lengkap')}}" class="form-control"
                                    name="nama_lengkap" id="nama_lengkap" placeholder="Nama Karyawan">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="status_approval" id="status_approval" class="form-select">
                                    <option value="">Status Approval</option>
                                    <option value="0" {{ Request('status_approval')==='0' ? 'selected' : '' }}>Waiting
                                    </option>
                                    <option value="1" {{ Request('status_approval')==1 ? 'selected' : '' }}>Disetujui
                                    </option>
                                    <option value="2" {{ Request('status_approval')==2 ? 'selected' : '' }}>Ditolak
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <button class="btn" type="submit" style="background-color: #FDB827; color: #F1F1F1;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                    <tbody>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Employee Code</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>keterangan</th>
                            <th>Status Approval</th>
                            <td>Aksi</td>
                        </tr>
                        </thead>
                        @foreach($mohonizin as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->permission_date}}</td>
                            <td>{{$d->nip}}</td>
                            <td>{{$d->nama_lengkap}}</td>
                            <td>{{$d->jabatan}}</td>
                            <td>{{$d->status== "i" ? "Izin" : "Sakit"}}</td>
                            <td>{{$d->keterangan}}</td>
                            <td>
                                @if($d->status_approval==1)
                                <span class="badge bg-success" style="color: #F1F1F1;">Disetujui</span>
                                @elseif($d->status_approval==2)
                                <span class="badge bg-danger" style="color: #F1F1F1;">Ditolak</span>
                                @else
                                <span class="badge bg-warning" style="color: #F1F1F1;">Waiting</span>
                                @endif
                            </td>
                            <td>
                                @if($d->status_approval==0)
                                <a href="#" class="btn btn-sm btn-primary" id="approve" id_mohonizin="{{$d->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-external-link" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                        <path d="M11 13l9 -9" />
                                        <path d="M15 4h5v5" />
                                    </svg>
                                </a>
                                @else
                                <a href="/presensi/{{$d->id}}/cancelizin" class="btn btn-sm btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-circle-x" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M10 10l4 4m0 -4l-4 4" />
                                    </svg>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$mohonizin-> links('')}}
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-mohonizin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Status Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/presensi/statusapproval" method="POST">
                    @csrf
                    <input type="hidden" id="id_mohonizinform" name="id_mohonizinform">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select name="status_app" id="status_app" class="form-select">
                                    <option value="1">Disetujui</option>
                                    <option value="2">Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100" type="submit"
                                    style="background-color: #FDB827; color: #F1F1F1;">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(function () {
        $("#approve").click(function (e) {
            e.preventDefault();
            var id_mohonizin = $(this).attr("id_mohonizin");
            $("#id_mohonizinform").val(id_mohonizin);
            $("#modal-mohonizin").modal("show");
        });
        $("#dari, #sampai").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy-mm-dd"
        });
    });
</script>
@endpush