<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Absensi</title>

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

        span.title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        table.tabeldatakaryawan {
            margin-top: 40px;
            font-weight: normal;
        }

        .tabeldatakaryawan td {
            padding: 5px;
        }

        .tabelabsensi {
            width: 100%;
            margin-top: 230px;
            border-collapse: collapse;
        }

        .tabelabsensi th {
            border: 1px solid rgb(0, 0, 0);
            padding: 8px;
            background-color: #a6d5ff;
        }

        .tabelabsensi td {
            border: 1px solid rgb(0, 0, 0);
            padding: 5px;
            font-size: 12px;
        }

        hr.garis {
            border: 1.5px solid rgb(0, 0, 0);
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
@php
    use Illuminate\Support\Facades\Storage;function selisih($jam_masuk, $jam_keluar) {
        // Tentukan jam kerja awal dan akhir
        $jam_awal = new DateTime('07:00');
        $jam_akhir = new DateTime('15:00');

        $jam_masuk = new DateTime($jam_masuk);
        $jam_keluar = new DateTime($jam_keluar);

        // Jika jam masuk lebih awal dari jam kerja, atur jam masuk ke jam kerja awal
        if ($jam_masuk < $jam_awal) {
            $jam_masuk = clone $jam_awal;
        }

        // Jika jam keluar lebih lambat dari jam kerja, atur jam keluar ke jam kerja akhir
        if ($jam_keluar > $jam_akhir) {
            $jam_keluar = clone $jam_akhir;
        }

        // Pastikan bahwa jam keluar tidak lebih awal dari jam masuk
        if ($jam_keluar < $jam_masuk) {
            $jam_keluar = clone $jam_masuk;
        }

        $interval = $jam_masuk->diff($jam_keluar);

        $jml_jam = $interval->h;
        $sisamenit2 = $interval->i;

        return $jml_jam . ":" . $sisamenit2;
    }
@endphp
    <!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <table style="width: 100%">
        <tr>
            <th style="width: 30px">
                <img src="{{ asset('../assets/images/logos/logo-kreasismi.png') }}" width="150">
            </th>

            <th>
                <span class="title">
                    LAPORAN ABSENSI INTERNSHIP<br>
                    PERIODE {{ strtoupper($namaBulan[$bulan]) }} {{ $tahun }}<br>
                    KOMITE EKONOMI KREATIF DAN INOVASI KOTA SUKABUMI <br>
                </span>

                <span>
                    <i>Jl. Cipelang Leutik No.217, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</i>
                </span>
            </th>
        </tr>
    </table>

    <hr class="garis">
    <table class="tabeldatakaryawan" align="left">
        <tr>
            <td rowspan="6">
                @php
//                    $path = Storage::url('public/foto_internship/'.$internship -> foto_internship);
                    $path = Storage::exists('public/foto_internship/'.$internship->foto_internship)
                            ? Storage::url('public/foto_internship/'.$internship->foto_internship)
                            : asset('assets/img/avatar/default.jpg');
                @endphp
                <img src="{{ $path }}" width="150">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td> :</td>
            <td>{{ $internship->nik }}</td>
        </tr>
        <tr>
            <td>Nama Internship</td>
            <td> :</td>
            <td>{{ $internship->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Posisi</td>
            <td> :</td>
            <td>{{ $internship->posisi }}</td>
        </tr>
        <tr>
            <td>Asal Instansi</td>
            <td> :</td>
            <td>{{ $internship->asal_instansi }}</td>
        </tr>
        <tr>
            <td>No. Handphone</td>
            <td> :</td>
            <td>{{ $internship->no_telepon }}</td>
        </tr>
    </table>

    <table class="tabelabsensi" align="center">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto</th>
            <th>Jam Pulang</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Jam Kerja</th>
        </tr>
        @foreach ($absensi as $row)
            @php
                $path_in        = Storage::url('public/foto_absensi/'.$row->foto_masuk);
                $path_out       = Storage::url('public/foto_absensi/'.$row->foto_keluar);
                $jamterlambat   = selisih('08:00:00', $row->jam_masuk);
            @endphp
            <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y", strtotime($row->tanggal_masuk)) }}</td>
                <td>{{ $row->jam_masuk }}</td>
                <td><img src="{{ $path_in }}" width="20%"></td>
                <td>{{ $row->jam_keluar != null ? $row->jam_keluar : 'Belum Absen' }}</td>
                <td>
                    @if ($row->foto_keluar != null)
                        <img src="{{ url($path_out) }}" width='20%'>
                    @else
                        <img src="{{ asset('assets/img/avatar/null.jpg') }}" width='20%'>
                    @endif
                </td>
                <td>
                    @if ($row->jam_masuk > '08:00:00')
                        Terlambat {{ $jamterlambat }}
                    @else
                        Tepat Waktu
                    @endif
                </td>
                <td>
                    @if ($row->jam_keluar != null)
                        @php
                            $jmljamkerja = selisih($row->jam_masuk, $row->jam_keluar);
                        @endphp
                    @else
                        @php
                            $jmljamkerja = 0;
                        @endphp
                    @endif
                    {{ $jmljamkerja }}
                </td>
            </tr>
        @endforeach
    </table>

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td colspan="2" style="text-align: right">Sukabumi, {{ date('d F Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: bottom" height="100px">
                <u>Anzhar Pratama</u><br>
                <i><b>Manager Bidang Analisis Data dan Sistem Informasi</b></i>
            </td>

            <td style="text-align: center; vertical-align: bottom">
                <u>Wega Gunawan</u><br>
                <i><b>Direktur</b></i>
            </td>
        </tr>
    </table>
</section>

</body>

</html>
