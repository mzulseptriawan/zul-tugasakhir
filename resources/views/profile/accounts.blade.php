@extends('layouts.template')
@section('title', 'Pusat Akun')
@section('content')
    <style>
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 0%;
            right: 820px;
            border: none;
            background: none;
            cursor: pointer;
        }
        .password-wrapper .invalid-feedback {
            display: block;
            position: absolute;
            top: 100%;
            right: 10px;
            transform: translateY(10%);
            width: auto;
        }
    </style>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pusat Akun</h5>
            <div class="card">
                <div class="card-body">
                    <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('updateAccount') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        @foreach ($dataAccount as $data)
                            <input type="hidden" name="id" class="form-control" id="id" value="{{ $data -> id }}" readonly>

                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Nama Panggilan</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName1" value="{{ $data -> name }}" aria-describedby="nameHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $data -> email }}" id="exampleInputEmail1">
                            </div>

                            <div class="mb-4 password-wrapper">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" oninput="validatePassword()" required>
                                <div class="invalid-feedback" id="passwordError">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="button" class="toggle-password" onclick="togglePassword('exampleInputPassword1', 'password-confirm')">👁️</button>
                            </div>

                            <div class="mb-4 password-wrapper">
                                <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" oninput="validatePassword()" required autocomplete="new-password">
                                <div class="invalid-feedback" id="confirmPasswordError">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputNohp1" class="form-label">No Handphone Aktif</label>
                                <input type="number" name="no_hp" class="form-control" value="{{ $data -> no_hp }}" id="exampleInputNohp1" oninput="validateNumberLength(this)">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputFoto1" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="exampleInputFoto1" onchange="previewImage(event)">
                                <img id="preview" src="#" alt="Pratinjau Gambar" style="display: none; margin-top: 10px; max-height: 200px;">
                            </div>

                            <a class="btn btn-danger" href="{{ route('profile') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(...ids) {
            ids.forEach(id => {
                var passwordField = document.getElementById(id);
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    document.querySelector('.toggle-password').textContent = '🙈';
                } else {
                    passwordField.type = 'password';
                    document.querySelector('.toggle-password').textContent = '👁️';
                }
            });
        }

        function validatePassword() {
            var passwordField = document.getElementById('exampleInputPassword1');
            var confirmPasswordField = document.getElementById('password-confirm');
            var password = passwordField.value;
            var confirmPassword = confirmPasswordField.value;
            var passwordError = document.getElementById('passwordError');
            var confirmPasswordError = document.getElementById('confirmPasswordError');
            var regex = /^.{8,}$/;

            if (!regex.test(password)) {
                passwordError.textContent = "Password harus minimal 8 karakter.";
                passwordField.classList.add('is-invalid');
                return false;
            } else {
                passwordError.textContent = "";
                passwordField.classList.remove('is-invalid');
            }

            if (password !== confirmPassword) {
                confirmPasswordError.textContent = "Konfirmasi password tidak cocok.";
                confirmPasswordField.classList.add('is-invalid');
                return false;
            } else {
                confirmPasswordError.textContent = "";
                confirmPasswordField.classList.remove('is-invalid');
            }

            return true;
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
    </script>
@endsection
