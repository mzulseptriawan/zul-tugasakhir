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
                                <h6 class="fw-semibold mb-0">Tanggal Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Waktu Masuk</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Lokasi Masuk</h6>
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
                        @php $no = 1; @endphp
                        @forelse($absensi as $data)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $data->nama_lengkap }}</h6>
                                    <span class="fw-normal">{{ $data->posisi }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> jam_masuk }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> tanggal_masuk }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> lokasi_masuk }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <img class="img-fluid" width="100" height="100" src="{{ url('storage/foto_absensi/' . $data->foto_masuk) }}" alt="Foto Masuk">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> tanggal_keluar }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> jam_keluar }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> lokasi_keluar }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <img class="img-fluid" width="100" height="100" src="{{ url('storage/foto_absensi/' . $data->foto_keluar) }}" alt="Foto Keluar">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $data -> keterangan }}</h6>
                                </td>
                                <td class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-menu-2 fs-6"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                        <div class="message-body">
                                            <a href="{{ route('pbDeleteAbsensi', $data -> id_internship) }}" class="d-flex align-items-center gap-2 dropdown-item" data-confirm-delete="true">
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
        } );
    </script>
@endsection
