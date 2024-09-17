@extends('layouts.template')
@section('title', 'Rekapitulasi Data Absensi')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title fw-semibold mb-4">Rekapitulasi Data Absensi</h2>
            <p>Ini adalah halaman <strong>Rekapitulasi Data Absensi</strong> yang tercatat.</p>
            <p>Anda dapat melakukan <strong>memilih</strong> data absensi yang akan dicetak.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Data Absensi</h5>
                    <form action="{{ route('pbCetakLaporan') }}" target="_blank" method="POST" id="form-laporan">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-select">
                                        <option value="">- Pilih Bulan -</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ date("m") ==$i ? 'selected' : ''}}>{{ $namaBulan[$i] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="tahun" id="tahun" class="form-select">
                                        <option value="">- Pilih Tahun -</option>
                                        @php
                                            $startYear     = 2022;
                                            $nowYear      = date("Y");
                                        @endphp
                                        @for ($year = $startYear; $year <=$nowYear; $year++)
                                            <option value="{{ $year }}" {{ date("Y") ==$year ? 'selected' : ''}}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="id_detail" id="id_detail" class="form-select">
                                        <option value="">- Pilih Internship -</option>
                                        @foreach ($pegawai as $row)
                                            <option value="{{ $row -> id_detail }}">{{ $row -> nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" name="cetak" class="btn btn-outline-primary w-100">
                                        Cetak
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Data Seluruh Absensi</h5>
                    <form action="{{ route('pbCetakRekap') }}" target="_blank" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="bulanRekap" id="bulan" class="form-select">
                                        <option value="">- Pilih Bulan -</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ date("m") ==$i ? 'selected' : ''}}>{{ $namaBulan[$i] }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="tahunRekap" id="tahun" class="form-select">
                                        <option value="">- Pilih Tahun -</option>
                                        @php
                                            $tahunMulai     = 2022;
                                            $tahunSkrg      = date("Y");
                                        @endphp
                                        @for ($tahun = $tahunMulai; $tahun <=$tahunSkrg; $tahun++)
                                            <option value="{{ $tahun }}" {{ date("Y") ==$tahun ? 'selected' : ''}}>{{ $tahun }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="id_detail" id="id_detail" class="form-select" disabled>
                                        <option value="">- Seluruh Internship -</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" name="cetakRekap" class="btn btn-outline-primary w-100">
                                        Cetak
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#form-laporan").submit(function(e) {
                var bulan   = $("#bulan").val();
                var tahun   = $("#tahun").val();
                var id_detail     = $("#id_detail").val();

                //validasi
                if(bulan == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Bulan Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $("#bulan").focus();
                    return false;
                } else if(tahun == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Tahun Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $("#tahun").focus();
                    return false;
                } else if(id_detail == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Internship Belum Dipilih!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $("#id_detail").focus();
                    return false;
                }
            });
        });
    </script>
@endpush
