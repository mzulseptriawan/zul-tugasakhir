@extends('layouts.template')
@section('title', 'Detail Data Diri')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Diri Anda</h5>
            <div class="card">
                <div class="card-body">
                    @if($detailAccount->isEmpty())
                        <div class="alert alert-warning text-center" role="alert">
                            Data Kosong, harap isi data terlebih dahulu <a href="{{ route('pbAccount', Auth::user() -> id_detail) }}">disini</a>.
                        </div>
                    @else
                        @foreach($detailAccount as $data)
                            <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('pbUpdateAccount') }}" method="POST" enctype="multipart/form-data" id="userForm">
                                @csrf
                                <input type="hidden" value="{{ $data->id_pegawai }}" name="id_pegawai" class="form-control" id="id" readonly>

                                <div class="row mb-3 justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <img class="img-fluid" width="200px" height="200px" src="{{ url('storage/foto_pegawai/' . $data->foto_pegawai) }}" alt="Foto Internship">
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <div class="col-md-12">
                                        <label for="exampleInputStatusPegawai1" class="form-label">Status Pegawai</label>
                                        <select name="status_pegawai" class="form-control" disabled>
                                            @if($data->status_pegawai == 'Aktif')
                                                <option value="{{ $data->status_pegawai }}">{{ $data->status_pegawai }}</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            @else
                                                <option value="{{ $data->status_pegawai }}">{{ $data->status_pegawai }}</option>
                                                <option value="Aktif">Aktif</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleInputNik1" class="form-label">NIK</label>
                                        <input type="number" value="{{ $data->nik }}" name="nik" class="form-control" id="exampleInputNik1" oninput="validateNikLength(this)" aria-describedby="nikHelp" maxlength="16" required>
                                        <div class="invalid-feedback" id="nikError">NIK harus terdiri dari 16 karakter.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputName1" class="form-label">Nama Lengkap</label>
                                        <input type="text" value="{{ $data->nama_lengkap }}" name="nama_lengkap" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleInputTempatLahir1" class="form-label">Tempat Lahir</label>
                                        <input type="text" value="{{ $data->tempat_lahir }}" name="tempat_lahir" class="form-control" id="exampleInputTempatLahir1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputTglLahir1" class="form-label">Tanggal Lahir</label>
                                        <input type="date" value="{{ $data->tanggal_lahir }}" name="tanggal_lahir" class="form-control" id="exampleInputTglLahir1" aria-describedby="emailHelp" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleInputJK1" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            @if($data->jenis_kelamin == 'Pria')
                                                <option value="{{ $data->jenis_kelamin }}">{{ $data->jenis_kelamin }}</option>
                                                <option value="Wanita">Wanita</option>
                                            @else
                                                <option value="{{ $data->jenis_kelamin }}">{{ $data->jenis_kelamin }}</option>
                                                <option value="Pria">Pria</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputAlamat1" class="form-label">Alamat Lengkap</label>
                                        <input type="text" value="{{ $data->alamat }}" name="alamat" class="form-control" id="exampleInputAlamat1" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleInputTelepon1" class="form-label">No Telepon</label>
                                        <input type="number" value="{{ $data->no_telepon }}" name="no_telepon" class="form-control" id="exampleInputTelepon1" oninput="validateNumberLength(this)" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" value="{{ $data->email }}" name="email" class="form-control" id="exampleInputEmail1" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleInputTglMasuk1" class="form-label">Tanggal Masuk</label>
                                        <input type="date" value="{{ $data->tanggal_masuk }}" name="tanggal_masuk" class="form-control" id="exampleInputTglMasuk1" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputPosisi1" class="form-label">Posisi</label>
                                        <input type="text" value="{{ $data->posisi }}" name="posisi" class="form-control" id="exampleInputPosisi1" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="exampleInputGaji1" class="form-label">Gaji</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="text" value="{{ $data->gaji }}" name="gaji" class="form-control" id="exampleInputHarga" oninput="formatRupiah(this)" aria-describedby="gajiHelp" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </form>
                        @endforeach
                        <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('pbUpdateFotoAccount') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @foreach($detailAccount as $data)
                                <div class="col-md-6">
                                    <label for="exampleInputFoto1" class="form-label">Foto</label>
                                    <input type="hidden" name="id_pegawai" class="form-control" value="{{ $data->id_pegawai }}">
                                    <input type="file" value="{{ $data->foto_pegawai }}" name="foto_pegawai" class="form-control" id="exampleInputFoto1" onchange="previewImage(event)">
                                </div>

                                <div class="row mb-3 justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <img id="preview" src="#" alt="Pratinjau Gambar" style="display: none; margin-top: 10px; max-height: 200px;">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-danger me-2" href="{{ route('pbIndex') }}">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Hanya Foto</button>
                                </div>
                            @endforeach
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateNikLength(input) {
            const nikError = document.getElementById('nikError');
            let value = input.value;

            // Membatasi input hanya sampai 16 karakter
            if (value.length > 16) {
                input.value = value.slice(0, 16);
            }

            // Menampilkan atau menyembunyikan pesan error
            if (input.value.length !== 16) {
                input.classList.add('is-invalid');
                nikError.style.display = 'block';
            } else {
                input.classList.remove('is-invalid');
                nikError.style.display = 'none';
            }
        }

        function togglePassword() {
            var passwordField = document.getElementById('exampleInputPassword1');
            if (document.getElementById('showPassword').checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }

        function formatRupiah(input) {
            let value = input.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            input.value = rupiah;
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function validateNumberLength(input) {
            const maxLength = 15; // Atur panjang maksimum sesuai kebutuhan
            let value = input.value;

            if (value.length > maxLength) {
                input.value = value.slice(0, maxLength);
            }
        }
    </script>
@endsection
