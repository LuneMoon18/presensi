<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A2</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A2
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
            font-size=10px;
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

<body class="A2 landscape">
    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <tr>
                <td style="width:30px">
                    <img src="{{asset('assets/img/profil.jpg')}}" width="70" height="70" alt="">
                </td>
                <td>
                    <span id="title">Rekap Absensi Karyawan<br>Bulan {{$namabulan[$bulan]}} {{$tahun}}<br>Indah
                        Motor<br></span>
                    <span><i>Jalaksana</i></span>
                </td>
            </tr>
        </table>
        <table class="tabelabsen" border="1">
            <tr>
                <th rowspan="2">NIP</th>
                <th rowspan="2">Nama Karyawan</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">TH</th>
            </tr>
            <tr>
                <?php
                for($i=1; $i<=31; $i++){
                ?>
                <th>{{$i}}</th>
                <?php
                }
                ?>
            </tr>
            @foreach ($rekap as $d)
            <tr>
                <td>{{$d->nip}}</td>
                <td>{{$d->nama_lengkap}}</td>

                <?php
                $totalhadir= 0;
                for($i=1; $i<=31; $i++){
                    $tgl = "tgl_".$i;
                    if(empty($d->$tgl)) {
                        $hadir = ['',''];
                        $totalhadir +=0;
                    }else
                    {
                        $hadir = explode("-", $d->$tgl);
                        $totalhadir +=1;
                    }
                    ?>
                <td>
                    <span>{{$hadir[0]}}</span><br>
                    <span>{{$hadir[1]}}</span>
                </td>
                <?php
                }
                ?>
                <td>{{$totalhadir}}</td>
            </tr>
            @endforeach
        </table>
        <table width="100%" style="margin-top: 100px">
            <tr>
                <td></td>
                <td style="text-align:center">
                    Kuningan, {{date ('d-m-Y')}}
                </td>
            </tr>
            <tr>
                <td style="text-align:center; vertical-align:bottom" height="150px">
                    <u>Nama Manajer</u><br>
                    <i><b>Manajer</b></i>
                </td>
                <td style="text-align:center; vertical-align:bottom">
                    <u>Nama Direktur</u><br>
                    <i><b>Direktur</b></i>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>