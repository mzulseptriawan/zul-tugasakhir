<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function cetakLaporanPerorang(Request $req) {
        $id = $req -> id_absensi;
        $bulan = $req -> bulan;
        $tahun = $req -> tahun;
    }
}
