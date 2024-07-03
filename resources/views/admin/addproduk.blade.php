@extends('layouts.template')
@section('title', 'Tambah Produk - Zul Editing')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Produk</h5>
            <div class="card">
                <div class="card-body">
                    <form class="col-xl-12 col-lg-12 col-md-12" action="{{ route('submitProduk') }}" method="POST"
                          enctype="multipart/form-data" onsubmit="removeFormatRupiah()">
                        @csrf
                        <input type="hidden" name="id_produk" class="form-control" id="id_produk" readonly>

                        <div class="mb-3">
                            <label for="exampleInputName1" class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" id="exampleInputName1" aria-describedby="nameHelp">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jenis Produk</label>
                            <input type="text" name="jenis_produk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Harga Produk</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="harga_produk" class="form-control" id="exampleInputHarga" oninput="formatRupiah(this)">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputAlamat1" class="form-label">Stok tersedia</label>
                            <input type="number" name="stok_produk" class="form-control" id="exampleInputAlamat1">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputFoto1" class="form-label">Foto Produk</label>
                            <input type="file" name="foto_produk" class="form-control" id="exampleInputFoto1" onchange="previewImage(event)">
                            <img id="preview" src="#" alt="Pratinjau Gambar" style="display: none; margin-top: 10px; max-height: 200px;">
                        </div>

                        <a class="btn btn-danger" href="{{ route('produkAdmin') }}">Kembali</a>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>
@endsection
