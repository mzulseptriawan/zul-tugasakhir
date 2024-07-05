<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function pegawai() {
        $query = array(
            'pegawai' => DB::table('data_pegawai')->get());

        return view('pembina.pegawai', $query);
    }

    public function detailPegawai($id) {
        $pegawai = DB::table('data_pegawai')->where('id_pegawai', $id)->get();

        return response()->json($pegawai);
    }

    public function addPegawai() {
        return view('pembina.pegawaiAdd');
    }

    public function submitPegawai() {

    }
}
