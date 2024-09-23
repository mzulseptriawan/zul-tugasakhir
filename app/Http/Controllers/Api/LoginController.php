<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi data input dari request
        $request -> validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $pegawai = DB::table('users')
            ->where('email', $request->email)
            ->first();

        $getId = DB::table('users')
            ->where('email', $request->email)
            ->value('id_detail');

        if ($getId <= 0) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid ID detail provided.',
            ], 400);
        }

        $verification = $pegawai && password_verify($request -> password, $pegawai -> password);

        if ($verification) {
            $response["error"]      = FALSE;
            $response["success"]    = 1;
            $response["message"]    = "Login berhasil!";
            $response["id_detail"]    = $getId;
        } else {
            $response["error"]      = TRUE;
            $response["success"]    = 0;
            $response["message"]    = "Login gagal. Email atau Password tidak sesuai!";
            $response["id_detail"]    = "ID Detail tidak tersedia.";
        }

        echo json_encode($response);
    }
}
