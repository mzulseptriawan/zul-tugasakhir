@extends('layouts.template')
@section('title', 'Pengaturan - Zul Editing')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title fw-semibold mb-4">Pengaturan Akun</h5>
                    <div class="card">
                        <img src="{{ url('storage/foto_akun/' . Auth::user() -> foto) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Halo, {{ Auth::user() -> name }}</h5>
                            <p class="card-text">Berikut diatas adalah foto profil anda,
                            atur foto profil anda di <a href="{{ url('settings/' . Auth::user()->id) }}">Pusat Akun.</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title fw-semibold mb-4">Privasi</h5>
                    <div class="card">
                        <div class="card-header">
                            Disarankan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Detail pribadi</h5>
                            <p class="card-text">Untuk mengatur berbagai detail akun, klik tombol dibawah ini.</p>
                            <a href="{{ url('settings/' . Auth::user()->id) }}" class="btn btn-primary">Pusat Akun</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="card-title fw-semibold mb-4">Alamat</h5>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Alamat Pengiriman</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ Auth::user() -> alamat }}</h6>
                            <p class="card-subtitle mb-2 text-muted">{{ Auth::user() -> no_hp }}</p>
                            <a href="{{ url('settings/' . Auth::user()->id) }}" class="btn btn-primary">Ubah Alamat</a>
                            <br>
                            <br>
                            <a href="{{ url('https://www.google.com/maps') }}" target="_blank" class="card-link">Lihat Lokasi Anda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
