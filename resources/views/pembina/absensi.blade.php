@extends('layouts.template')
@section('title', 'Data Absensi')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fw-semibold mb-4">Data Absensi</h2>
            <p>Ini adalah halaman <strong>Data Absensi</strong> yang tercatat.</p>
            <p>Anda dapat melakukan <strong>Melihat, dan Menghapus</strong> data absensi yang tercatat.</p>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Absensi</h5>
                <div class="table-responsive">
                    <table id="example" class="table text-nowrap mb-0 align-middle display">
                        <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Jenis Absensi</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Waktu Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Lokasi Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Peta Lokasi Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Foto Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Tanggal Keluar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Waktu Keluar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Lokasi Keluar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Peta Lokasi Keluar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Foto Keluar</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Keterangan</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse($absensi as $data)
                            @php
                                $fotoUrl = '';
                                if ($data->jenis_absensi == 'Hadir') {
                                    $fotoUrl = url('storage/api/uploads/foto_absensi/foto_masuk/' . $data->foto_masuk);
                                } elseif ($data->jenis_absensi == 'Sakit') {
                                    $fotoUrl = url('storage/api/uploads/foto_absensi/foto_sakit/' . $data->foto_masuk);
                                } elseif ($data->jenis_absensi == 'Izin') {
                                    $fotoUrl = url('storage/api/uploads/foto_absensi/foto_izin/' . $data->foto_masuk);
                                } else {
                                    $fotoUrl = 'https://via.placeholder.com/100x100?text=No+Image';
                                }

                                // Koordinat untuk peta
                                $apiKey = env('API_KEY_GMAPS');
                                $defaultCoordinates = ['-6.902882586503939', '106.9325702637434']; // Koordinat default

                                // Ambil koordinat lokasi masuk
                                $coordinatesMasuk = explode(',', $data->lokasi_masuk) ?: $defaultCoordinates;
                                $latitudeMasuk = isset($coordinatesMasuk[0]) ? trim($coordinatesMasuk[0]) : $defaultCoordinates[0];
                                $longitudeMasuk = isset($coordinatesMasuk[1]) ? trim($coordinatesMasuk[1]) : $defaultCoordinates[1];

                                // Ambil koordinat lokasi keluar
                                $coordinatesKeluar = explode(',', $data->lokasi_keluar) ?: $defaultCoordinates;
                                $latitudeKeluar = isset($coordinatesKeluar[0]) ? trim($coordinatesKeluar[0]) : $defaultCoordinates[0];
                                $longitudeKeluar = isset($coordinatesKeluar[1]) ? trim($coordinatesKeluar[1]) : $defaultCoordinates[1];

                                // Buat URL untuk peta lokasi masuk
                                $mapUrlMasuk = "https://www.google.com/maps/embed/v1/view?key={$apiKey}&center={$latitudeMasuk},{$longitudeMasuk}&zoom=15";

                                // Buat URL untuk peta lokasi keluar
                                $mapUrlKeluar = "https://www.google.com/maps/embed/v1/view?key={$apiKey}&center={$latitudeKeluar},{$longitudeKeluar}&zoom=15";
                            @endphp
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $data->nama_lengkap }}</h6>
                                    <span class="fw-normal">{{ $data->posisi }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $data->jenis_absensi }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data->tanggal_masuk }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data->jam_masuk }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $latitudeMasuk }}</h6>
                                    <h6 class="fw-semibold mb-0">{{ $longitudeMasuk }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <iframe src="{{ $mapUrlMasuk }}" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" onclick=""></iframe> <!-- Embed Peta -->
                                </td>
                                <td class="border-bottom-0">
                                    <img class="img-fluid" width="100" height="100" src="{{ $fotoUrl }}" alt="Foto Masuk">
                                </td>
                                <td class="border-bottom-0">
                                    @if (!$data -> tanggal_keluar == \PHPUnit\Framework\isEmpty())
                                        <h6 class="fw-semibold mb-0">Pengguna belum/tidak</h6>
                                        <h6 class="fw-semibold mb-0">melakukan absensi keluar.</h6>
                                    @else
                                        <h6 class="fw-semibold mb-0">{{ $data->tanggal_keluar }}</h6>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    @if (!$data -> jam_keluar == \PHPUnit\Framework\isEmpty())
                                        <h6 class="fw-semibold mb-0">Pengguna belum/tidak</h6>
                                        <h6 class="fw-semibold mb-0">melakukan absensi keluar.</h6>
                                    @else
                                        <h6 class="fw-semibold mb-0">{{ $data->jam_keluar }}</h6>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    @if (!$data -> lokasi_keluar == \PHPUnit\Framework\isEmpty())
                                        <h6 class="fw-semibold mb-0">Pengguna belum/tidak</h6>
                                        <h6 class="fw-semibold mb-0">melakukan absensi keluar.</h6>
                                    @else
                                        <h6 class="fw-semibold mb-0">{{ $latitudeKeluar }}</h6>
                                        <h6 class="fw-semibold mb-0">{{ $longitudeKeluar }}</h6>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    @if (!$data -> lokasi_keluar == \PHPUnit\Framework\isEmpty())
                                        <h6 class="fw-semibold mb-0">Pengguna belum/tidak</h6>
                                        <h6 class="fw-semibold mb-0">melakukan absensi keluar.</h6>
                                    @else
                                        <iframe src="{{ $mapUrlKeluar }}" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" onclick=""></iframe>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    <img class="img-fluid" width="100" height="100" src="{{ url('storage/api/uploads/foto_absensi/foto_keluar/' . $data->foto_keluar) }}" alt="Foto Keluar">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data->keterangan }}</h6>
                                </td>
                                <td class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-menu-2 fs-6"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                        <div class="message-body">
                                            <a href="{{ route('pbDeleteAbsensi', $data->id_internship) }}" class="d-flex align-items-center gap-2 dropdown-item" data-confirm-delete="true">
                                                <i class="ti ti-trash fs-6"></i>
                                                <p class="mb-0 fs-3">Hapus Data</p>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Data Absensi Kosong</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        import DataTable from 'datatables.net-dt';

        let table = new DataTable('#myTable', {
            responsive: true
        });

        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
