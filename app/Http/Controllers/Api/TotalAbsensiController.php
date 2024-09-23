<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TotalAbsensiResource;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalAbsensiController extends Controller
{
    public function countHadir() {
        $countHadir = DB::table('absensis')->where('jenis_absensi', 'Hadir')->count();

        return response()->json(['count' => $countHadir]);
    }

    public function countSakit() {
        $countSakit = DB::table('absensis')->where('jenis_absensi', 'Sakit')->count();

        return response()->json(['count' => $countSakit]);
    }

    public function countIzin() {
        $countIzin = DB::table('absensis')->where('jenis_absensi', 'Izin')->count();

        return response()->json(['count' => $countIzin]);
    }

    public function countAlfa() {
        $countAlfa = DB::table('absensis')->where('jenis_absensi', 'Alfa')->count();

        return response()->json(['count' => $countAlfa]);
    }
}
