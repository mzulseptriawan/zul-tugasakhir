<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DataAbsensiController extends Controller
{
    public function absensi() {
        $query = array(
            'absensi' => DB::table('absensis')
                ->join('internships', 'absensis.id_detail', '=', 'internships.id_detail')
                ->select('absensis.*', 'internships.*')->get()
        );

        return view('pembina.absensi', $query);
    }

    public function deleteAbsensi($id) {
        $query = DB::table('absensis')
            ->where('id_absensi', $id)
            ->delete();

        if ($query) {
            Alert('Berhasil', 'Data absensi berhasil dihapus!','success');
            return redirect('/pembina/absensi');
        } else {
            Alert('Gagal', 'Data absensi gagal dihapus!','error');
            return redirect('/pembina/absensi');
        }
    }

    public function laporan() {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $pegawai = DB::table('internships')->orderBy('nama_lengkap')->get();

        return view('pembina.laporan', compact('namaBulan', 'pegawai'));
    }

    public function cetakLaporan(Request $req) {
        $id_detail  = $req  ->  id_detail;
        $bulan      = $req  ->  bulan;
        $tahun      = $req  ->  tahun;
        $namaBulan  = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $internship = DB::table('absensis')
            ->join('internships', 'absensis.id_detail', '=', 'internships.id_detail')
            ->select('absensis.*', 'internships.*')
            ->first();
        $absensi    = DB::table('absensis')
            ->where('id_detail', $id_detail)
            ->whereRaw('MONTH(tanggal_masuk)="'.$bulan.'"')
            ->whereRaw('YEAR(tanggal_masuk)="'.$tahun.'"')
            ->orderBy('tanggal_masuk')
            ->get();

        return view('pembina.cetaklaporan', compact('bulan', 'tahun', 'namaBulan', 'internship','absensi'));
    }
}
