<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/icon-kreasismi.png') }}" />
    <link rel="stylesheet" href="{{ asset('../assets/css/styles.min.css') }}" />
    <style>
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 0%;
            right: 500px;
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
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="./" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="../assets/images/logos/logo-kreasismi.png" width="180" alt="">
                            </a>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" name="id">
                                <input type="hidden" name="level" value="3">

                                <div class="mb-3">
                                    <label for="exampleInputName1" class="form-label">Nama Panggilan</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputName1" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <label for="exampleInputNohp1" class="form-label">No Handphone</label>
                                    <input name="no_hp" type="text" class="form-control" id="exampleInputNohp1" oninput="validateNumberLength(this)" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>

                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Sudah memiliki akun?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route("login") }}">Masuk disini!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('sweetalert::alert')

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
</script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
