@extends('layouts.presensi')
@section('header')
<div class="appHeader text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Riwayat Absen</div>
    <div class="right"></div>
</div>
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <select name="month" id="month" class="form-control">
                        <option value="">Bulan</option>
                        @for($i= 1; $i <= 12; $i++) <option value="{{$i}}" {{date("m")==$i ? 'selected' : '' }}>
                            {{$bulan[$i]}}</option>
                            @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <select name="year" id="year" class="form-control">
                        <option value="">Tahun</option>
                        @php
                        $startingyear = 2022;
                        $currentyear = date("Y");
                        @endphp
                        @for ($year= $startingyear; $year <= $currentyear; $year++) <option value="{{$year}}"
                            {{date("Y")==$year ? 'selected' : '' }}>{{$year}}</option>
                            @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-block" id="getdata">
                        <ion-icon name="search-outline"></ion-icon>
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col" id="showriwayat">
    </div>
    @endsection

    @push('myscript')
    <script>
        $(function () {
            $("#getdata").click(function (e) {
                var month = $("#month").val();
                var year = $("#year").val();
                $.ajax({
                    type: 'POST',
                    url: '/getriwayat',
                    data: {
                        _token: "{{csrf_token()}}",
                        month: month,
                        year: year,
                    }
                    , cache: false
                    , success: function (respond) {
                        $('#showriwayat').html(respond);
                    }
                });
            });
        });
    </script>
    @endpush