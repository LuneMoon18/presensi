<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvatica, sans-serif;
            font-size: 16 px;
            font-weight: bold;

        }

        .datakaryawan {
            margin-top: 40px;
        }

        .datakaryawan tr td {
            padding: 5px;
        }

        .tabelabsen {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .tabelabsen tr th {
            border: 1px solid #131212;
            padding: 8px;
            background-color: #dbdbdb;
        }

        .tabelabsen tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 12px;
        }

        .foto {
            width: 30px;
            height: 40px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <tr>
                <td style="width:30px">
                    <img src="{{asset('assets/img/logo.jpg')}}" width="70" height="70" alt="">
                </td>
                <td>
                    <span id="title">Laporan Absensi Karyawan<br>Bulan {{$namabulan[$bulan]}} {{$tahun}}<br>Indah
                        Motor<br></span>
                    <span><i>Jl. Raya Jalaksana No. 219, Kecamatan Jalaksana, Kabupaten Kuningan, Jawa Barat</i></span>
                </td>
            </tr>
        </table>
        <table class="datakaryawan">
            <tr>
                <td rowspan="6">
                    @php
                    $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                    @endphp
                    <img src={{url($path)}} width="150" height="150" alt="">
                </td>
            </tr>
            <tr>
                <td>Employee Code</td>
                <td>:</td>
                <td>{{$karyawan->nip}}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{$karyawan->nama_lengkap}}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{$karyawan->jabatan}}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>:</td>
                <td>{{$karyawan->kode_divisi}}</td>
            </tr>
            <tr>
                <td>No. Handphone</td>
                <td>:</td>
                <td>{{$karyawan->no_hp}}</td>
            </tr>
        </table>
        <table class="tabelabsen">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Keterangan</th>
                <th>Jam Pulang</th>
            </tr>
            @foreach ($presensi as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date("d-m-Y", strtotime($d->presence_date))}}</td>
                <td>{{$d->time_in}}</td>
                <td>@if($d->time_in>'07.00')
                    Terlambat
                    @else
                    Tepat Waktu
                    @endif
                </td>
                <td>{{$d->time_out != null ? $d->time_out : 'Belum Absen'}}</td>
            </tr>
            @endforeach
        </table>
        <table width="100%" style="margin-top: 100px">
            <tr>
                <td colspan="2" style="text-align:right">
                    Kuningan, {{date ('d-m-Y')}}
                </td>
            </tr>
            <tr>
                <td style="text-align:center; vertical-align:bottom" height="150px">
                    <u>Mochamad Ryan Ferdiansyah</u><br>
                    <i><b>Manajer</b></i>
                </td>
                <td style="text-align:center; vertical-align:bottom">
                    <u>H. Toto Suharto</u><br>
                    <i><b>Direktur</b></i>
                </td>
            </tr>

        </table>
    </section>
</body>

</html>