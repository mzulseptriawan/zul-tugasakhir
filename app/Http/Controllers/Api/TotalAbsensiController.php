<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TotalAbsensiResource;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalAbsensiController extends Controller
{
    public function countHadir($id_detail) {
        $countHadir = Absensi::where('id_detail', $id_detail)
            ->where('jenis_absensi', 'Hadir')
            ->count();

        return response()->json([
            'success' => true,
            'count' => $countHadir,
        ]);
    }

    public function countSakit($id_detail) {
        $countSakit = Absensi::where('id_detail', $id_detail)
            ->where('jenis_absensi', 'Sakit')
            ->count();

        return response()->json([
            'success' => true,
            'count' => $countSakit,
        ]);
    }

    public function countIzin($id_detail) {
        $countIzin = Absensi::where('id_detail', $id_detail)
            ->where('jenis_absensi', 'Izin')
            ->count();

        return response()->json([
            'success' => true,
            'count' => $countIzin,
        ]);
    }

    public function countAlfa($id_detail) {
        $countAlfa = Absensi::where('id_detail', $id_detail)
            ->where('jenis_absensi', 'Alfa')
            ->count();

        return response()->json([
            'success' => true,
            'count' => $countAlfa,
        ]);
    }
}
