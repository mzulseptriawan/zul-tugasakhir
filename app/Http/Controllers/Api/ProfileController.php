<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Internship;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($id_detail)
    {
        // Mengambil profile berdasarkan id_detail
        $profile = Internship::where('id_detail', $id_detail)->get();

        // Jika data ditemukan, kembalikan response-nya
        if ($profile->isNotEmpty()) {
            return new ProfileResource(true, 'Data Profile Ditemukan', $profile);
        }

        // Jika tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Profile Tidak Ditemukan'
        ], 404);
    }

    public function editProfile(Request $req)
    {
        // Validasi input
        $validatedData = $req->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
        ]);

        // Temukan pengguna berdasarkan ID
        $profile = DB::table('internships')
            ->where('id_detail', $req->id_detail)
            ->first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        // Update data hanya untuk pengguna dengan id_detail tertentu
        DB::table('internships')
            ->where('id_detail', $req->id_detail)  // Tambahkan kondisi where ini untuk membatasi update
            ->update([
                'nama_lengkap' => $req->nama_lengkap,
                'alamat' => $req->alamat,
                'no_telepon' => $req->no_telepon,
                'updated_at' => Carbon::now(),
            ]);

        return response()->json(['data' => [
            'nama_lengkap' => $req->nama_lengkap,
            'alamat' => $req->alamat,
            'no_telepon' => $req->no_telepon,
            'updated_at' => Carbon::now(),
        ]], 200);
    }

}
