@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Profil Perusahaan
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
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                    role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>
                                    Profil
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            @if(Session::get('warning'))
                            <div class="alert alert-warning">
                                {{Session::get('warning')}}
                            </div>
                            @endif
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" name="kode_pos"
                                            value="{{$profil->kode_pos}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Nama Web</label>
                                        <input type="text" class="form-control" name="nama_web"
                                            value="{{$profil->nama_web}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" name="deskripsi"
                                            value="{{$profil->deskripsi}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" class="form-control" name="no_hp" value="{{$profil->no_hp}}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{$profil->alamat}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Alamat Website</label>
                                        <input type="text" class="form-control" name="alamat_web"
                                            value="{{$profil->alamat_web}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" class="form-control" name="nama_perusahaan"
                                            value="{{$profil->nama_perusahaan}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Nama Direktur</label>
                                        <input type="text" class="form-control" name="directur_name"
                                            value="{{$profil->nama_direktur}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Nama Manager</label>
                                        <input type="text" class="form-control" name="nama_manager"
                                            value="{{$profil->nama_manager}}" readonly>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="update btn w-100"
                                                style="background-color: #FDB827; color: #F1F1F1;"
                                                kode_pos="{{$profil->kode_pos}}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-rotate" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
                                                </svg>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-editprofil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadeditForm">

            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(".update").click(function () {
        var kode_pos = $(this).attr('kode_pos');
        $.ajax({
            type: 'POST',
            url: '/profil/editprofil',
            cache: false,
            data: {
                _token: "{{ csrf_token() }}",
                kode_pos: kode_pos
            },
            success: function (respond) {
                $("#loadeditForm").html(respond);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        })
        $("#modal-editprofil").modal("show");
    });
</script>
@endpush