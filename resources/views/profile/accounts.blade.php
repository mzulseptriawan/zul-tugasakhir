@extends('layouts.template')
@section('title', 'Pusat Akun')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pusat Akun</h5>
            <div class="card">
                <div class="card-body">
                    <form class="col-xl-12 col-lg-12 col-md-12" action="" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        @foreach ($dataAccount as $data)
                            <input type="hidden" name="id" class="form-control" id="id" value="{{ $data -> id }}" readonly>

                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" id="exampleInputName1" value="{{ $data -> name }}" aria-describedby="nameHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{ $data -> email }}" aria-describedby="emailHelp">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePassword()">
                                <label class="form-check-label" for="exampleCheck1">Tampilkan Password</label>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputAlamat1" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $data -> alamat }}" id="exampleInputAlamat1">
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
    </script>
@endsection
