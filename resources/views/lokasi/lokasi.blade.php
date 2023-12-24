@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Lokasi Kantor
                </h2>
            </div>
        </div>
    </div>
</div>
<style>
    #map {
        height: 200px;
    }
</style>
<!--Leaflet-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                                        <path d="M9 4v13" />
                                        <path d="M15 7v5.5" />
                                        <path
                                            d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                        <path d="M19 18v.01" />
                                    </svg>
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
                        @csrf
                        <div class=" tab-content">
                            <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" name="kode_pos"
                                            value="{{$lokasi->kode_pos}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{$lokasi->alamat}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" class="form-control" name="latitude"
                                            value="{{$lokasi->latitude}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" class="form-control" name="longitude"
                                            value="{{$lokasi->longitude}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Radius</label>
                                        <input type="text" class="form-control" name="radius"
                                            value="{{$lokasi->radius}}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Peta</label>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="update btn w-100"
                                                style="background-color: #FDB827; color: #F1F1F1;"
                                                kode_pos="{{$lokasi->kode_pos}}">
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
<div class="modal modal-blur fade" id="modal-editlokasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Lokasi</h5>
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
            url: '/lokasi/editlokasi',
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
        $("#modal-editlokasi").modal("show");
    });
    var map = L.map('map').setView([-6.9292462788064535, 108.48665992284027], 18);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 25,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([-6.9292462788064535, 108.48665992284027]).addTo(map);
    var circle = L.circle([-6.9292462788064535, 108.48665992284027], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 5
    }).addTo(map);
</script>
@endpush