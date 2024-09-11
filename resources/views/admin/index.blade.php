@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 border-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="ti ti-user text-white fs-5"></i>
                        </div>
                        <h5 class="card-title fw-semibold ms-3 mb-0">Jumlah Pegawai yang Terdaftar</h5>
                    </div>
                    <h2 class="fw-bold text-primary mb-0">{{ $totalPegawai }}</h2>
                    <p class="text-muted mt-2">Total Pegawai yang terdaftar di sistem</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100 border-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar-sm bg-success rounded-circle d-flex align-items-center justify-content-center">
                            <i class="ti ti-user text-white fs-5"></i>
                        </div>
                        <h5 class="card-title fw-semibold ms-3 mb-0">Jumlah Internship yang Terdaftar</h5>
                    </div>
                    <h2 class="fw-bold text-success mb-0">{{ $totalInternship }}</h2>
                    <p class="text-muted mt-2">Total Internship yang terdaftar di sistem</p>
                </div>
            </div>
        </div>
    </div>

    {{--Tabel pengguna--}}
    <div class="row mt-4">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Pengguna</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">E-mail</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                            @if($users)
                                @foreach($users as $data)
                                    <tr>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $no++ }}</h6></td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $data->name }}</h6>
                                            <span class="fw-normal">
                                            @if ($data->level == '1')
                                                    Admin
                                                @elseif ($data->level == '2')
                                                    Pembina
                                                @elseif($data->level == '3')
                                                    Member
                                                @else
                                                    Tidak diketahui
                                                @endif
                                        </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $data->email }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                            <span class="
                                            @if($data->status == 'Aktif') badge bg-success rounded-3 fw-semibold
                                            @else badge bg-danger rounded-3 fw-semibold
                                            @endif">
                                                {{ $data->status }}
                                            </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Tanggal dan Jam -->
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Waktu hari ini</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 id="clock" class="fw-semibold mb-3"></h4>
                            <p id="date" class="fs-3 mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pengguna -->
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Seluruh Pengguna</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTime() {
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const now = new Date().toLocaleTimeString('id-ID', options);
            document.getElementById('clock').textContent = now;
        }

        function updateDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('date').textContent = today;
        }

        setInterval(updateTime, 1000); // Perbarui setiap detik
        updateTime(); // Panggil sekali untuk menampilkan waktu saat halaman dimuat
        updateDate(); // Panggil fungsi untuk menampilkan tanggal saat halaman dimuat
    </script>
@endsection
