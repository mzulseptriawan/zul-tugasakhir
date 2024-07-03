@extends('layouts.template')
@section('title', 'Tambah Pengguna')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Pengguna</h5>
            <div class="card">
                <div class="card-body">
                    @foreach($users as $data)
                        <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('adUpdate') }}" method="POST" enctype="multipart/form-data" id="userForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data -> id }}" class="form-control" id="id" readonly>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="exampleInputName1" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $data -> name }}" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" oninput="validatePassword()" required>
                                <label class="form-check-label d-block" style="margin-top: 12px;">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePassword()"> Tampilkan Password
                                </label>
                                <div class="invalid-feedback" id="passwordError"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                                <input type="email" name="email" value="{{ $data -> email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputNohp1" class="form-label">No Handphone Aktif</label>
                                <input type="number" name="no_hp" class="form-control" id="exampleInputNohp1" oninput="validateNumberLength(this)" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputLevel1" class="form-label">Role Akses</label>
                                <select name="level" class="form-control" required>
                                    <option value="">- Pilih Salah Satu -</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Pembina</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputFoto1" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="exampleInputFoto1" onchange="previewImage(event)" required>
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-6 text-center">
                                <img id="preview" src="#" alt="Pratinjau Gambar" style="display: none; margin-top: 10px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a class="btn btn-danger me-2" href="{{ route('adUser') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
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

        document.getElementById('userForm').addEventListener('submit', function (e) {
            if (!validatePassword()) {
                e.preventDefault();
            }
        });
    </script>
@endsection
