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
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Absensi</th>
                            <th>Tanggal Masuk</th>
                            <th>Waktu Masuk</th>
                            <th>Peta Lokasi Masuk</th>
                            <th>Foto Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Waktu Keluar</th>
                            <th>Peta Lokasi Keluar</th>
                            <th>Foto Keluar</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
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
                                    $fotoUrl = 'https://via.placeholder.com/200x200?text=No+Image';
                                }

                                // Ambil koordinat lokasi masuk
                                $coordinatesMasuk = explode(',', $data->lokasi_masuk);
                                $latitudeMasuk = isset($coordinatesMasuk[0]) ? trim($coordinatesMasuk[0]) : null;
                                $longitudeMasuk = isset($coordinatesMasuk[1]) ? trim($coordinatesMasuk[1]) : null;

                                // Ambil koordinat lokasi keluar
                                $coordinatesKeluar = explode(',', $data->lokasi_keluar);
                                $latitudeKeluar = isset($coordinatesKeluar[0]) ? trim($coordinatesKeluar[0]) : null;
                                $longitudeKeluar = isset($coordinatesKeluar[1]) ? trim($coordinatesKeluar[1]) : null;
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $data->nama_lengkap }}</h6>
                                    <span class="fw-normal">{{ $data->posisi }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <select name="jenis_absensi" class="form-select" data-id="{{ $data->id_absensi }}">
                                        <option value="Hadir" @if($data->jenis_absensi == 'Hadir') selected @endif>Hadir</option>
                                        <option value="Sakit" @if($data->jenis_absensi == 'Sakit') selected @endif>Sakit</option>
                                        <option value="Izin" @if($data->jenis_absensi == 'Izin') selected @endif>Izin</option>
                                        <option value="Alfa" @if($data->jenis_absensi == 'Alfa') selected @endif>Alfa</option>
                                    </select>
                                </td>
                                <td>{{ $data->tanggal_masuk }}</td>
                                <td>{{ $data->jam_masuk }}</td>
                                <td>
                                    <div id="map-masuk-{{ $data->id_absensi }}" style="height: 200px;"></div>
                                </td>
                                <td><img class="img-fluid" width="100" height="100" src="{{ $fotoUrl }}" alt="Foto Masuk"></td>
                                <td>{{ $data->tanggal_keluar ?? 'Belum absen keluar' }}</td>
                                <td>{{ $data->jam_keluar ?? 'Belum absen keluar' }}</td>
                                <td>
                                    <div id="map-keluar-{{ $data->id_absensi }}" style="height: 200px;"></div>
                                </td>
                                <td><img class="img-fluid" width="100" height="100" src="{{ url('storage/api/uploads/foto_absensi/foto_keluar/' . $data->foto_keluar) }}" alt="Foto Keluar"></td>
                                <td>{{ $data->keterangan }}</td>
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
                                <td colspan="15" class="text-center">Data Absensi Kosong</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--for OSM--}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @forelse($absensi as $data)
            var latitudeMasuk = {{ $latitudeMasuk ?? 'null' }};
            var longitudeMasuk = {{ $longitudeMasuk ?? 'null' }};
            var latitudeKeluar = {{ $latitudeKeluar ?? 'null' }};
            var longitudeKeluar = {{ $longitudeKeluar ?? 'null' }};

            if (latitudeMasuk && longitudeMasuk) {
                var mapMasuk = L.map('map-masuk-{{ $data->id_absensi }}').setView([latitudeMasuk, longitudeMasuk], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mapMasuk);
                L.marker([latitudeMasuk, longitudeMasuk]).addTo(mapMasuk);
            }

            if (latitudeKeluar && longitudeKeluar) {
                var mapKeluar = L.map('map-keluar-{{ $data->id_absensi }}').setView([latitudeKeluar, longitudeKeluar], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mapKeluar);
                L.marker([latitudeKeluar, longitudeKeluar]).addTo(mapKeluar);
            }
            @empty
            @endforelse
        });
    </script>

    {{--  for dropdown jenis_absensi  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Ketika status absensi diubah
            $('select[name="jenis_absensi"]').change(function() {
                var absensiId = $(this).data('id');
                var newStatus = $(this).val();
                var dropdown = $(this);

                // Menggunakan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan mengubah jenis absensi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('pbUpdateJenisAbsensi') }}', // Route update absensi
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id_absensi": absensiId,
                                "jenis_absensi": newStatus
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Jenis absensi berhasil diperbarui.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Memuat ulang halaman setelah sukses
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat memperbarui absensi.',
                                    'error'
                                );
                            }
                        });
                    } else {
                        // Kembalikan dropdown ke status sebelumnya jika dibatalkan
                        dropdown.val(dropdown.find('option[selected]').val());
                    }
                });
            });
        });
    </script>
@endsection
