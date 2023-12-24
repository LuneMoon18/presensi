@extends ('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Presensi Online</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    #map {
        height: 500px;
    }
</style>
<!--Leaflet-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <input type="hidden" id="lokasi">
        <div class="col">
        </div>
    </div>
</div>

<!--Menampilkan peta-->
<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>

<div class="row mt-2">
    <div class="col">
        @if($cek > 0)
        <button id="takeabsen" class="btn btn-danger btn-block">
            <ion-icon name="checkbox-outline"></ion-icon>
            Check out
        </button>
        @else
        <button id="takeabsen" class="btn btn-block">
            <ion-icon name="checkbox-outline"></ion-icon>
            Check in
        </button>
        @endif
    </div>
</div>
@endsection
@push('myscript')
<script>

    //elemen dari id lokasi
    var lokasi = document.getElementById('lokasi');

    //deteksi geolocation user
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errrorCallback);
    }
    function successCallback(position) {
        lokasi.value = position.coords.latitude + ", " + position.coords.longitude;

        //menampilkan peta ke layar
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

        //penentuan radius diisi dengan latlong kantor
        var circle = L.circle([position.coords.latitude, position.coords.longitude],
            {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 5
            }).addTo(map);
    }
    function errrorCallback() {

    }

    //ambilabsen
    $("#takeabsen").click(function (e) {
        var lokasi = $("#lokasi").val();
        $.ajax({
            type: 'POST',
            url: '/presensi/store',
            data: {
                _token: "{{ csrf_token() }}",
                lokasi: lokasi
            },
            cache: false,
            success: function (respond) {
                var status = respond.split("|");
                if (status[0] === "success") {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: status[1],
                        icon: 'success'
                    });

                    setTimeout(function () {
                        location.href = '/dashboard';
                    }, 3000);
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: status[1],
                        icon: 'error',
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat melakukan absensi.',
                    icon: 'error',
                });
            }
        });
    });

</script>
@endpush