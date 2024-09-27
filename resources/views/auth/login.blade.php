<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/icon-kreasismi.png') }}" />
    <link rel="stylesheet" href="{{ asset('../assets/css/styles.min.css') }}" />
    <style>
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 0%;
            left: 70px;
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
                            <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="../assets/images/logos/logo-kreasismi.png" width="180" alt="">
                            </a>
                            <form method="POST" action="{{ route('login') }}" id="userForm">
                                @csrf
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
                                    <button type="button" class="toggle-password" onclick="togglePassword()">👁️</button>
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" oninput="validatePassword()" required>
                                    <div class="invalid-feedback" role="alert" id="passwordError">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
{{--                                <div class="d-flex align-items-center justify-content-center">--}}
{{--                                    <p class="fs-4 mb-0 fw-bold">Belum memiliki akun?</p>--}}
{{--                                    <a class="text-primary fw-bold ms-2" href="{{ route("register") }}">Daftar disini!</a>--}}
{{--                                </div>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')

<script>
    function togglePassword() {
        var passwordField = document.getElementById('exampleInputPassword1');
        var toggleButton = document.querySelector('.toggle-password');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.textContent = '🙈';
        } else {
            passwordField.type = 'password';
            toggleButton.textContent = '👁️';
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
</script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
