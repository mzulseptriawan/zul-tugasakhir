@extends('layouts.template')
@section('title', 'Internship')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fw-semibold mb-4">Data Internship</h2>
            <p>Ini adalah halaman <strong>Data Internship</strong> yang terdaftar.</p>
            <p>Anda dapat melakukan <strong>Penambahan, Mengubah, dan Menghapus</strong> internship yang terdaftar.</p>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Data Internship</h5>
                <a class="btn btn-primary" href="{{ route('pbAddInternship') }}">Tambahkan Internship</a>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Foto</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                            </th>

                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $no = 1; @endphp
                        @if($internship)
                            @foreach($internship as $data)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                    </td>

                                    <td class="border-bottom-0">
                                        <img class="img-fluid" width="100" height="100" src="{{ url('storage/foto_internship/' . $data->foto_internship) }}" alt="Foto Internship">
                                        <span class="fw-normal">{{ $data->posisi }}</span>
                                    </td>

                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $data->nama_lengkap }}</h6>
                                        <span class="fw-normal">{{ $data->posisi }}</span>
                                    </td>

                                    <td class="nav-item dropdown">
                                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-menu-2 fs-6"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                            <div class="message-body">
                                                <a class="d-flex align-items-center gap-2 dropdown-item btn-detail dropdown-item" href="javascript:void(0)" data-id-internship="{{ $data->id_internship }}">
                                                    <i class="ti ti-eye fs-6"></i>
                                                    <p class="mb-0 fs-3">Lihat Detail</p>
                                                </a>
                                                <a href="{{ route('pbDeleteInternship', $data -> id_internship) }}" class="d-flex align-items-center gap-2 dropdown-item" data-confirm-delete="true">
                                                    <i class="ti ti-trash fs-6"></i>
                                                    <p class="mb-0 fs-3">Hapus Data</p>
                                                </a>
                                                <a href="{{ route('pbEditInternship', $data -> id_internship) }}" class="d-flex align-items-center gap-2 dropdown-item">
                                                    <i class="ti ti-pencil fs-6"></i>
                                                    <p class="mb-0 fs-3">Edit Data</p>
                                                </a>
                                            </div>
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

    <!-- Modal Trigger -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Internship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="internship-detail">
                        <!-- Data internship akan dimuat di sini -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            class InternshipDetailHandler {
                constructor() {
                    this.detailButtons = document.querySelectorAll('.btn-detail');
                    this.detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                    this.internshipDetail = document.getElementById('internship-detail');
                    this.initEvents();
                }

                initEvents() {
                    this.detailButtons.forEach(button => {
                        button.addEventListener('click', this.handleDetailClick.bind(this));
                    });
                }

                handleDetailClick(event) {
                    const button = event.currentTarget;
                    const id = button.getAttribute('data-id-internship');
                    this.fetchInternshipDetail(id);
                }

                fetchInternshipDetail(id) {
                    fetch(`/pembina/internship/detail/${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Tidak ada respon dari server.');
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.displayInternshipDetail(data);
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            this.internshipDetail.innerHTML = `<p class="text-danger">Terjadi kesalahan: ${error.message}</p>`;
                            this.detailModal.show();
                        });
                }

                displayInternshipDetail(data) {
                    this.internshipDetail.innerHTML = `
                <p><strong>NIK:</strong> ${data[0].nik}</p>
                <p><strong>Nama:</strong> ${data[0].nama_lengkap}</p>
                <p><strong>Tempat Lahir:</strong> ${data[0].tempat_lahir}</p>
                <p><strong>Tanggal Lahir:</strong> ${data[0].tanggal_lahir}</p>
                <p><strong>Asal Instansi:</strong> ${data[0].asal_instansi}</p>
                <p><strong>Jenis Kelamin:</strong> ${data[0].jenis_kelamin}</p>
                <p><strong>Alamat:</strong> ${data[0].alamat}</p>
                <p><strong>No Telepon:</strong> ${data[0].no_telepon}</p>
                <p><strong>Email:</strong> ${data[0].email}</p>
                <p><strong>Tanggal Masuk:</strong> ${data[0].tanggal_masuk}</p>
                <p><strong>Posisi:</strong> ${data[0].posisi}</p>
                <p><strong>Status Internship:</strong> ${data[0].status_internship}</p>
            `;
                    this.detailModal.show();
                }

            }

            new InternshipDetailHandler();
        });

    </script>
@endsection
