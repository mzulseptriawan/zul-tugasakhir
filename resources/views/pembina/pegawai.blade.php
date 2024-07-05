@extends('layouts.template')
@section('title', 'Pegawai')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fw-semibold mb-4">Data Pegawai</h2>
            <p>Ini adalah halaman <strong>Data Pegawai</strong> yang terdaftar.</p>
            <p>Anda dapat melakukan <strong>Penambahan, Mengubah, dan Menghapus</strong> pegawai yang terdaftar.</p>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Daftar Pegawai</h5>
                <a class="btn btn-primary" href="#">Tambahkan Pegawai</a>
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
                        @if($pegawai)
                            @foreach($pegawai as $data)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $no++ }}</h6></td>
                                    <td class="border-bottom-0">
                                        <img class="img-fluid" width="100" height="100" src="{{ url('storage/foto_pegawai/' . $data->foto_pegawai) }}" alt="Foto Pegawai">
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $data->nama_lengkap }}</h6>
                                        <span class="fw-normal">{{ $data->posisi }}</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <button class="btn btn-primary btn-detail" data-id-pegawai="{{ $data->id_pegawai }}">Lihat Detail</button>
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
                    <h5 class="modal-title" id="detailModalLabel">Detail Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="pegawai-detail">
                        <!-- Data pegawai akan dimuat di sini -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function Modal Detail Pegawai
        document.addEventListener('DOMContentLoaded', function () {
            const detailButtons = document.querySelectorAll('.btn-detail');
            const detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
            const pegawaiDetail = document.getElementById('pegawai-detail');

            detailButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id-pegawai');
                    fetch(`/pembina/pegawai/${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            pegawaiDetail.innerHTML = `
                                <p><strong>NIK:</strong> ${data[0].nik}</p>
                                <p><strong>Nama:</strong> ${data[0].nama_lengkap}</p>
                                <p><strong>Tanggal Lahir:</strong> ${data[0].tanggal_lahir}</p>
                                <p><strong>Jenis Kelamin:</strong> ${data[0].jenis_kelamin}</p>
                                <p><strong>Alamat:</strong> ${data[0].alamat}</p>
                                <p><strong>No Telepon:</strong> ${data[0].no_telepon}</p>
                                <p><strong>Email:</strong> ${data[0].email}</p>
                                <p><strong>Tanggal Masuk:</strong> ${data[0].tanggal_masuk}</p>
                                <p><strong>Posisi:</strong> ${data[0].posisi}</p>
                                <p><strong>Gaji:</strong> ${formatRupiah(data[0].gaji, 'Rp. ')}</p>
                                <p><strong>Status Pegawai:</strong> ${data[0].status_pegawai}</p>
                            `;
                            detailModal.show();
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            pegawaiDetail.innerHTML = `<p class="text-danger">Error fetching data: ${error.message}</p>`;
                            detailModal.show();
                        });
                });
            });
        });

        // Convertion number to rupiah
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection
