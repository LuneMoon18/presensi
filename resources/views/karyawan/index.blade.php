@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <h2 class="page-title">
          Data Karyawan
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
            <div class="row">
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
            </div>
            <div class="row">
              <div class="col-12">
                <a href="#" class="btn" id="btnTambahKaryawan" style="background-color: #FDB827; color: #F1F1F1;">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                  </svg>
                  Tambah Data</a>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-12">
                <form action="/karyawan" method="GET">
                  <div class="row">
                    <div class="col-10">
                      <div class="form-group">
                        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control"
                          placeholder="Nama Karyawan" value="{{Request('nama_karyawan')}}">
                      </div>
                    </div>
                    <div class="col-2">
                      <div class="form-group">
                        <button type="submit" class="btn" style="background-color: #FDB827; color: #F1F1F1;">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
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
            <div class="row mt-2">
              <div class="col-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Employee Code</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>No Handphone</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($karyawan as $d)
                    @php
                    $path = Storage::url('uploads/karyawan/' . $d->foto);
                    @endphp
                    <tr>
                      <td>{{$loop->iteration + $karyawan-> firstItem()-1}}</td>
                      <td>{{$d->nip}}</td>
                      <td>{{$d->nama_lengkap}}</td>
                      <td>{{$d->jabatan}}</td>
                      <td>{{$d->no_hp}}</td>
                      <td>
                        @if(empty($d->foto))
                        <img src="{{asset('assets/img/noprofil.png')}}" class="avatar" alt="">
                        @else
                        <img src="{{url($path)}}" class="avatar" alt="">
                        @endif
                      </td>
                      <td>
                        <div class="btn-group">
                          <a href="#" class="edit btn btn-success btn-sm" nip="{{$d->nip}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                              stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                              <path d="M16 5l3 3" />
                            </svg>
                          </a>
                          <form action="/karyawan/{{$d-> nip}}/delete" method="POST" style="margin-left: 5px">
                            @csrf
                            <a class="btn btn-danger btn-sm confirm-delete">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7l16 0" />
                                <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                              </svg>
                            </a>
                          </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{$karyawan-> links('')}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Karyawan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/karyawan/store" method="POST" id="formKaryawan" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 12h3v4h-3z" />
                    <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                    <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                    <path d="M14 16h2" />
                    <path d="M14 12h4" />
                  </svg>
                </span>
                <input type="text" value="" class="form-control" name="nip" id="nip" placeholder="Employee Code">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                  </svg>
                </span>
                <input type="text" value="" class="form-control" name="nama_lengkap" id="nama_lengkap"
                  placeholder="Nama Lengkap">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-histogram"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 3v18h18" />
                    <path d="M20 18v3" />
                    <path d="M16 16v5" />
                    <path d="M12 13v8" />
                    <path d="M8 16v5" />
                    <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />
                  </svg>
                </span>
                <input type="text" value="" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <select name="kode_divisi" id="kode_divisi" class="form-select">
                  <option value="" selected disabled>Divisi</option>
                  @foreach ($divisi as $d)
                  <option {{Request ('kode_divisi')==$d-> kode_divisi ? 'selected': ''}} value="{{$d->kode_divisi}}">
                    {{$d->nama_divisi}}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-calling" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                      d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    <path d="M15 7l0 .01" />
                    <path d="M18 7l0 .01" />
                    <path d="M21 7l0 .01" />
                  </svg>
                </span>
                <input type="text" value="" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Handphone">
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              <div class="mb-3">
                <div class="form-label">
                  Upload Foto
                </div>
                <input type="file" class="form-control" id="foto" name="foto">
              </div>
            </div>
          </div>
          <div class="row Mmt-2">
            <div class="col-12">
              <div class="form-group">
                <button class="btn w-100" style="background-color: #FDB827; color: #F1F1F1;">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 9l5 -5l5 5" />
                    <path d="M12 4l0 12" />
                  </svg>
                  Simpan
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Karyawan</h5>
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
  $(function () {
    //menambahkan data karyawan
    $("#btnTambahKaryawan").click(function () {
      $("#modal-inputkaryawan").modal("show");
    });

    //edit data karyawan
    $(".edit").click(function () {
      var nip = $(this).attr('nip');
      $.ajax({
        type: 'POST',
        url: '/karyawan/edit',
        cache: false,
        data: {
          _token: "{{csrf_token()}}"
          , nip: nip
        }
        , success: function (respond) {
          $("#loadeditForm").html(respond);
        }
      })
      $("#modal-editkaryawan").modal("show");
    });

    //delete data karyawan
    $(".confirm-delete").click(function (e) {
      var form = $(this).closest('form');
      e.preventDefault();
      Swal.fire({
        title: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data Akan Terhapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya"
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
          Swal.fire({
            title: "Deleted!",
            text: "Data Berhasil Dihapus",
            icon: "success"
          });
        }

      });
    });

    //tambah data karyawan
    $("#formKaryawan").submit(function () {
      var nip = $("#nip").val();
      var nama_lengkap = $("#nama_lengkap").val();
      var jabatan = $("#jabatan").val();
      var no_hp = $("#no_hp").val();

      if (nip == "") {
        Swal.fire({
          title: 'Oops!',
          text: 'Employee Code tidak boleh kosong',
          icon: 'warning',
          confirmButtonText: 'OK'
        }).then((result) => {
          $('#nip').focus();
        });
        return false;
      }
      else if (nama_lengkap == "") {
        Swal.fire({
          title: 'Oops!',
          text: 'Nama tidak boleh kosong',
          icon: 'warning',
          confirmButtonText: 'OK'
        }).then((result) => {
          $('#nama_lengkap').focus();
        });
        return false;
      }
      else if (jabatan == "") {
        Swal.fire({
          title: 'Oops!',
          text: 'Jabatan tidak boleh kosong',
          icon: 'warning',
          confirmButtonText: 'OK'
        }).then((result) => {
          $('#jabatan').focus();
        });
        return false;
      }
      else if (no_hp == "") {
        Swal.fire({
          title: 'Oops!',
          text: 'Nomor Handphone tidak boleh kosong',
          icon: 'warning',
          confirmButtonText: 'OK'
        }).then((result) => {
          $('#no_hp').focus();
        });
        return false;
      }
    });
  });
</script>
@endpush