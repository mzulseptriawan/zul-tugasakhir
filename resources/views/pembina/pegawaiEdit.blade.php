@extends('layouts.template')
@section('title', 'Edit Pegawai')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Data Pegawai</h5>
            <div class="card">
                <div class="card-body">
                    @foreach($pegawai as $data)
                        <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('pbUpdatePegawai') }}" method="POST" enctype="multipart/form-data" id="userForm">
                        @csrf
                            <input type="hidden" value="{{ $data -> id_pegawai }}" name="id_pegawai" class="form-control" id="id" readonly>

                            <div class="row mb-6">
                                <div class="col-md-12">
                                    <label for="exampleInputStatusPegawai1" class="form-label">Status Pegawai</label>
                                    <select name="status_pegawai" class="form-control">
                                        @if($data -> status_pegawai == 'Aktif')
                                            <option value="{{ $data -> status_pegawai }}">{{ $data -> status_pegawai }}</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        @else
                                            <option value="{{ $data -> status_pegawai }}">{{ $data -> status_pegawai }}</option>
                                            <option value="Aktif">Aktif</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputNik1" class="form-label">NIK</label>
                                    <input type="number" value="{{ $data -> nik }}" name="nik" class="form-control" id="exampleInputNik1" oninput="validateNikLength(this)" aria-describedby="nikHelp" maxlength="16" required>
                                    <div class="invalid-feedback" id="nikError">NIK harus terdiri dari 16 karakter.</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputName1" class="form-label">Nama Lengkap</label>
                                    <input type="text" value="{{ $data -> nama_lengkap }}" name="nama_lengkap" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputTempatLahir1" class="form-label">Tempat Lahir</label>
                                    <input type="text" value="{{ $data -> tempat_lahir }}" name="tempat_lahir" class="form-control" id="exampleInputTempatLahir1" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputTglLahir1" class="form-label">Tanggal Lahir</label>
                                    <input type="date" value="{{ $data -> tanggal_lahir }}" name="tanggal_lahir" class="form-control" id="exampleInputTglLahir1" aria-describedby="emailHelp" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputJK1" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        @if($data -> jenis_kelamin == 'Pria')
                                            <option value="{{ $data -> jenis_kelamin }}">{{ $data -> jenis_kelamin }}</option>
                                            <option value="Wanita">Wanita</option>
                                        @else
                                            <option value="{{ $data -> jenis_kelamin }}">{{ $data -> jenis_kelamin }}</option>
                                            <option value="Pria">Pria</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputAlamat1" class="form-label">Alamat Lengkap</label>
                                    <input type="text" value="{{ $data -> alamat }}" name="alamat" class="form-control" id="exampleInputAlamat1" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputTelepon1" class="form-label">No Telepon</label>
                                    <input type="number" value="{{ $data -> no_telepon }}" name="no_telepon" class="form-control" id="exampleInputTelepon1" oninput="validateNumberLength(this)" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" value="{{ $data -> email }}" name="email" class="form-control" id="exampleInputEmail1" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputTglMasuk1" class="form-label">Tanggal Masuk</label>
                                    <input type="date" value="{{ $data -> tanggal_masuk }}" name="tanggal_masuk" class="form-control" id="exampleInputTglMasuk1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputPosisi1" class="form-label">Posisi</label>
                                    <input type="text" value="{{ $data -> posisi }}" name="posisi" class="form-control" id="exampleInputPosisi1" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="exampleInputGaji1" class="form-label">Gaji</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" value="{{ $data -> gaji }}" name="gaji" class="form-control" id="exampleInputHarga" oninput="formatRupiah(this)" aria-describedby="gajiHelp" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputJK1" class="form-label">Hubungkan dengan Akun</label>
                                    <select name="id_detail" class="form-control">
                                        <option value="">- Tidak Ada/Pilih Salah Satu -</option>
                                            @foreach($idDetail as $users)
                                                <option value="{{ $users->id_detail }}">{{ $users->name }}</option>
                                            @endforeach
                                    </select>
                                    @foreach($nameDetail as $nameUsers)
                                        <p class="text-muted mt-2">Saat ini pegawai terhubung dengan akun {{ $nameUsers -> name }}</p>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                    </form>
                    @endforeach
                    <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('pbUpdateFotoPegawai') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach($pegawai as $data)
                            <div class="col-md-6">
                            <label for="exampleInputFoto1" class="form-label">Foto</label>
                            <input type="hidden" name="id_pegawai" class="form-control" value="{{ $data -> id_pegawai }}">
                            <input type="file" value="{{ $data -> foto_pegawai }}" name="foto_pegawai" class="form-control" id="exampleInputFoto1" onchange="previewImage(event)">
                        </div>

                            <div class="row mb-3 justify-content-center">
                            <div class="col-md-6 text-center">
                                <img id="preview" src="#" alt="Pratinjau Gambar" style="display: none; margin-top: 10px; max-height: 200px;">
                            </div>
                        </div>

                            <div class="d-flex justify-content-end">
                            <a class="btn btn-danger me-2" href="{{ route('pbPegawai') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary">Hanya Foto</button>
                        </div>
                        @endforeach
                    </form>
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
            if (document.getElementById('exampleCheck1').checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }

        function validateNumberLength(input) {
            let value = input.value;
            if (value.startsWith('0')) {
                value = '62' + value.slice(1);
            }
            if (value.length > 14) {
                value = value.slice(0, 14);
            }
            input.value = value;
        }

        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        function validatePassword() {
            var passwordField = document.getElementById('exampleInputPassword1');
            var password = passwordField.value;
            var passwordError = document.getElementById('passwordError');
            var regex = /^.{8,}$/;

            if (!regex.test(password)) {
                passwordError.textContent = "Password harus minimal 8 karakter.";
                passwordField.classList.add('is-invalid');
                return false;
            } else {
                passwordError.textContent = "";
                passwordField.classList.remove('is-invalid');
                return true;
            }
        }

        function formatRupiah(input) {
            var value = input.value.replace(/[^,\d]/g, '');
            var split = value.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            input.value = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        function removeFormatRupiah() {
            var input = document.getElementById('exampleInputHarga');
            input.value = input.value.replace(/\./g, '');
        }

        document.getElementById('exampleInputNik1').addEventListener('input', function() {
            validateNikLength(this);
        });

        document.getElementById('userForm').addEventListener('submit', function (e) {
            const nikInput = document.getElementById('exampleInputNik1');
            if (!validatePassword()) {
                e.preventDefault();
            }
            if (nikInput.value.length !== 16) {
                e.preventDefault();
                validateNikLength(nikInput);
            }
        });
    </script>
@endsection
