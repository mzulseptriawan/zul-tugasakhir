@extends('layouts.template')
@section('title', 'Pengaturan Akun')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
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

                <div class="col-md-6">
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

            </div>
        </div>
    </div>
@endsection
