@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title fw-semibold mb-4">Waktu Sekarang</h2>
            <h3 id="clock"></h3>
            <p id="calendar"></p>
        </div>
    </div>

    <div class="row">
        <!-- Card for Internship -->
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 border-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar-sm bg-success rounded-circle d-flex align-items-center justify-content-center">
                            <i class="ti ti-user text-white fs-5"></i>
                        </div>
                        <h5 class="card-title fw-semibold ms-3 mb-0">Rekapitulasi Absensi Internship</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Hadir</h6>
                                    <h4 class="fw-bold text-primary">{{$totalHadirAbsensi}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-danger">Sakit</h6>
                                    <h4 class="fw-bold text-danger">{{$totalSakitAbsensi}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-warning">Izin</h6>
                                    <h4 class="fw-bold text-warning">{{$totalIzinAbsensi}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-secondary">Alfa</h6>
                                    <h4 class="fw-bold text-secondary">{{$totalAlfaAbsensi}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-2">Total Internship yang melakukan absensi</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateTime() {
            const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const now = new Date().toLocaleTimeString('id-ID', options);
            document.getElementById('clock').textContent = now;
        }

        function updateDate() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const now = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('calendar').textContent = now;
        }

        updateDate();
        updateTime();
        setInterval(updateTime, 1000);
    </script>
@endsection
