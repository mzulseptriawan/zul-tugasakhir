@extends('layouts.template')
@section('title', 'Pengguna')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fw-semibold mb-4">Data Pengguna</h2>
            <p>Ini adalah halaman <strong>Pengguna</strong> yang terdaftar.</p>
            <p>Anda dapat melakukan <strong>Penambahan, Mengubah, dan Menghapus</strong> pengguna yang terdaftar.</p>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Daftar Pengguna</h5>
                <a class="btn btn-primary" href="{{ route('adAdd') }}">Tambahkan Pengguna</a>
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
                                <h6 class="fw-semibold mb-0">No Handphone</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Foto</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
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
                                        <p class="mb-0 fw-normal">{{ $data->no_hp }}</p>
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
                                    <td class="border-bottom-0">
                                        <img class="img-fluid" width="100" height="100" src="{{ url('storage/foto_akun/' . $data->foto) }}">
                                    </td>
                                    <th class="nav-item dropdown">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-menu-2 fs-6"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                            <div class="message-body">
                                                <a href="{{ route('adDelete', $data -> id) }}" class="d-flex align-items-center gap-2 dropdown-item" data-confirm-delete="true">
                                                    <i class="ti ti-trash fs-6"></i>
                                                    <p class="mb-0 fs-3">Hapus Pengguna</p>
                                                </a>
                                                <a href="{{ route('adEdit', $data -> id) }}" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-pencil fs-6"></i>
                                                    <p class="mb-0 fs-3">Edit Pengguna</p>
                                                </a>
                                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item" onclick="confirmChangeStatus({{ $data -> id }})">
                                                    <i class="ti ti-forbid-2 fs-6"></i>
                                                    <p class="mb-0 fs-3">Ganti Status Pengguna</p>
                                                </a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmChangeStatus(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengubah status pengguna ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/users/status',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Berhasil!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        }
            function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Pengguna!',
                text: "Apakah anda yakin ingin menghapus pengguna ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/users/delete/' + id;
                }
            })
        }
    </script>
@endsection
