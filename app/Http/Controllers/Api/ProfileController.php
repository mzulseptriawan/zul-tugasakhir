<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Internship;
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
//        $profile = Internship::all();
//
//        return new ProfileResource(true, 'List Data Profile', $profile);
    }
}
