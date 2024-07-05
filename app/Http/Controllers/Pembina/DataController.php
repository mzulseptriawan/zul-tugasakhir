<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function pegawai() {
        $pegawai = DB::table('data_pegawai')->get();
        $idPegawai = DB::table('data_pegawai')->where('id_pegawai')->get();

        return view('pembina.pegawai', compact('pegawai','idPegawai'));
    }

    public function detailPegawai($id) {
        $pegawai = DB::table('data_pegawai')->where('id_pegawai', $id)->get();

        return response()->json($pegawai);
    }
}
