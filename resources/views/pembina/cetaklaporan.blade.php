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

<body class="A4">
@php
    use Illuminate\Support\Facades\Storage;

    function selisih($jam_masuk, $jam_keluar) {
        $jam_awal = new DateTime('08:00:00');
        $jam_akhir = new DateTime('15:00:00');

        $jam_masuk = new DateTime($jam_masuk);
        $jam_keluar = new DateTime($jam_keluar);

        if ($jam_masuk < $jam_awal) {
            $jam_masuk = clone $jam_awal;
        }

        if ($jam_keluar > $jam_akhir) {
            $jam_keluar = clone $jam_akhir;
        }

        if ($jam_keluar < $jam_masuk) {
            $jam_keluar = clone $jam_masuk;
        }

        $interval = $jam_masuk->diff($jam_keluar);
        $jml_jam = $interval->h;
        $sisamenit2 = $interval->i;

        return $jml_jam . ":" . str_pad($sisamenit2, 2, '0', STR_PAD_LEFT);
    }
@endphp

<section class="sheet padding-10mm">
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
                    $path = Storage::exists('public/foto_internship/'.$internship -> foto_internship)
                    ? Storage::url('public/foto_internship/'.$internship -> foto_internship)
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
            <th>Tepat Waktu / Terlambat</th>
            <th>Keterangan</th>
            <th>Jam Kerja</th>
        </tr>
        @foreach ($absensi as $row)
            @php
                $fotoUrl = '';
                if ($row->jenis_absensi == 'Hadir') {
                    $fotoUrl = url('storage/api/uploads/foto_absensi/foto_masuk/' . $row->foto_masuk);
                } elseif ($row->jenis_absensi == 'Sakit') {
                    $fotoUrl = url('storage/api/uploads/foto_absensi/foto_sakit/' . $row->foto_masuk);
                } elseif ($row->jenis_absensi == 'Izin') {
                    $fotoUrl = url('storage/api/uploads/foto_absensi/foto_izin/' . $row->foto_masuk);
                } else {
                    $fotoUrl = 'https://via.placeholder.com/100x100?text=No+Image';
                }

                $jamterlambat = selisih('08:00:00', $row->jam_masuk);
            @endphp
            <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ date("d-m-Y", strtotime($row->tanggal_masuk)) }}</td>
                <td>{{ $row->jam_masuk }}</td>
                <td><img src="{{ $fotoUrl }}" width="20%"></td>
                <td>{{ $row->jam_keluar != null ? $row->jam_keluar : 'Belum Absen' }}</td>
                <td>
                    @if ($row->foto_keluar != null)
                        <img src="{{ url('storage/api/uploads/foto_absensi/foto_keluar/' . $row->foto_keluar) }}" width='20%'>
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
                    {{ $row -> keterangan }}
                </td>
                <td>
                    @if ($row->jam_keluar != null)
                        @php
                            $jmljamkerja = selisih($row->jam_masuk, $row->jam_keluar);
                        @endphp
                    @else
                        @php
                            $jmljamkerja = '00:00';
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
                <i><b>Manager Bidang Sekretariat</b></i>
            </td>
            <td style="text-align: center; vertical-align: bottom">
                <u>{{ $internship->nama_lengkap }}</u><br>
                <i><b>{{ $internship->posisi }}</b></i>
            </td>
        </tr>
    </table>
</section>
</body>
</html>
