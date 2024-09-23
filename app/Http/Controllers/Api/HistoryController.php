<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function getHistory(Request $request)
    {
        // Get data id_detail
        $user = DB::table('users')
            ->where('id_detail', '=', $request->id_detail)
//            ->where('id_detail', $id)
            ->first();

        // Mengambil data absensi berdasarkan user yang login
        $riwayatAbsensi = Absensi::where('id_detail', $user -> id_detail)
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        // Cek apakah ada data absensi
        if ($riwayatAbsensi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data absensi yang tersedia'
            ], 404);
        }

        // Jika data absensi ada
        return response()->json([
            'success' => true,
            'data' => $riwayatAbsensi
        ], 200);
    }

}
