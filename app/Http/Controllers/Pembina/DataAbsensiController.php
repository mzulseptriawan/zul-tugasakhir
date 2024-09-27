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

    public function cetakRekap(Request $request) {
        $bulan  = $request -> bulanRekap;
        $tahun  = $request -> tahunRekap;

        $rekap  = DB::table('absensis')
            ->selectRaw('absensis.id_detail,nik, nama_lengkap,
        MAX(IF(DAY(absensis.tanggal_masuk) = 1, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_1,
        MAX(IF(DAY(absensis.tanggal_masuk) = 2, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_2,
        MAX(IF(DAY(absensis.tanggal_masuk) = 3, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_3,
        MAX(IF(DAY(absensis.tanggal_masuk) = 4, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_4,
        MAX(IF(DAY(absensis.tanggal_masuk) = 5, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_5,
        MAX(IF(DAY(absensis.tanggal_masuk) = 6, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_6,
        MAX(IF(DAY(absensis.tanggal_masuk) = 7, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_7,
        MAX(IF(DAY(absensis.tanggal_masuk) = 8, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_8,
        MAX(IF(DAY(absensis.tanggal_masuk) = 9, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_9,
        MAX(IF(DAY(absensis.tanggal_masuk) = 10, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_10,
        MAX(IF(DAY(absensis.tanggal_masuk) = 11, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_11,
        MAX(IF(DAY(absensis.tanggal_masuk) = 12, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_12,
        MAX(IF(DAY(absensis.tanggal_masuk) = 13, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_13,
        MAX(IF(DAY(absensis.tanggal_masuk) = 14, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_14,
        MAX(IF(DAY(absensis.tanggal_masuk) = 15, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_15,
        MAX(IF(DAY(absensis.tanggal_masuk) = 16, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_16,
        MAX(IF(DAY(absensis.tanggal_masuk) = 17, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_17,
        MAX(IF(DAY(absensis.tanggal_masuk) = 18, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_18,
        MAX(IF(DAY(absensis.tanggal_masuk) = 19, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_19,
        MAX(IF(DAY(absensis.tanggal_masuk) = 20, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_20,
        MAX(IF(DAY(absensis.tanggal_masuk) = 21, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_21,
        MAX(IF(DAY(absensis.tanggal_masuk) = 22, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_22,
        MAX(IF(DAY(absensis.tanggal_masuk) = 23, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_23,
        MAX(IF(DAY(absensis.tanggal_masuk) = 24, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_24,
        MAX(IF(DAY(absensis.tanggal_masuk) = 25, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_25,
        MAX(IF(DAY(absensis.tanggal_masuk) = 26, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_26,
        MAX(IF(DAY(absensis.tanggal_masuk) = 27, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_27,
        MAX(IF(DAY(absensis.tanggal_masuk) = 28, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_28,
        MAX(IF(DAY(absensis.tanggal_masuk) = 29, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_29,
        MAX(IF(DAY(absensis.tanggal_masuk) = 30, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_30,
        MAX(IF(DAY(absensis.tanggal_masuk) = 31, CONCAT(jam_masuk,"-",IFNULL(jam_keluar,"00:00:00")),"")) as tgl_31')
            ->join('internships', 'absensis.id_detail', '=', 'internships.id_detail')
            ->whereRaw('MONTH(absensis.tanggal_masuk)="'.$bulan.'"')
            ->whereRaw('YEAR(absensis.tanggal_masuk)="'.$tahun.'"')
            ->groupByRaw('absensis.id_detail, nik, nama_lengkap')
            ->get();

        $namaBulan      = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('pembina.cetakrekap', compact('rekap', 'bulan', 'tahun', 'namaBulan'));
    }
}
