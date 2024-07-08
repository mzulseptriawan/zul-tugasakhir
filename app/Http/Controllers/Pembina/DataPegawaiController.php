<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPegawaiController extends Controller
{
    public function pegawai() {
        $query = array(
            'pegawai' => DB::table('pegawais')->get());

        $title = 'Peringatan!';
        $text = "Anda yakin ingin menghapus data ini? Tindakan anda tidak dapat dibatalkan!";
        confirmDelete($title, $text);

        return view('pembina.pegawai', $query);
    }

    public function detailPegawai($id) {
        $pegawai = DB::table('pegawais')->where('id_pegawai', $id)->get();

        return response()->json($pegawai);
    }

    public function addPegawai() {
        return view('pembina.pegawaiAdd');
    }

    public function submitPegawai(Request $req) {
        try {
            $this->validate($req,[
                'foto_pegawai'      => 'required|image|mimes:png,jpg,jpeg,webp'
            ]);

            //upload image
            $image = $req->file('foto_pegawai');
            $image -> storeAs('public/foto_pegawai', $image -> hashName());
            $query = DB::table('pegawais')
                ->insert([
                    'id_pegawai'     => $req -> id_pegawai,
                    'nik'            => $req -> nik,
                    'nama_lengkap'   => $req -> nama_lengkap,
                    'tempat_lahir'   => $req -> tempat_lahir,
                    'tanggal_lahir'  => $req -> tanggal_lahir,
                    'jenis_kelamin'  => $req -> jenis_kelamin,
                    'alamat'         => $req -> alamat,
                    'no_telepon'     => $req -> no_telepon,
                    'email'          => $req -> email,
                    'tanggal_masuk'  => $req -> tanggal_masuk,
                    'posisi'         => $req -> posisi,
                    'gaji'           => $req -> gaji,
                    'status_pegawai' => 'Aktif',
                    'foto_pegawai'   => $image -> hashName(),
                    'created_at'     => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data pegawai berhasil disimpan!','success');
                return redirect('/pembina/pegawai');
            } else {
                Alert('Gagal', 'Data pegawai gagal disimpan!','error');
                return redirect('/pembina/pegawai/add');
            }
        } catch (\Exception $e) {
            Alert('Data pegawai gagal disimpan!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/pegawai/add');
        }
    }

    public function editPegawai($id) {
        $pegawai = DB::table('pegawais')->where('id_pegawai', $id)->get();

        return view('pembina.pegawaiEdit', compact('pegawai'));
    }

    public function updatePegawai(Request $req) {
        try {
            $query = DB::table('pegawais')
                ->where('id_pegawai', $req -> id_pegawai)
                ->update([
                    'id_pegawai'     => $req -> id_pegawai,
                    'nik'            => $req -> nik,
                    'nama_lengkap'   => $req -> nama_lengkap,
                    'tempat_lahir'   => $req -> tempat_lahir,
                    'tanggal_lahir'  => $req -> tanggal_lahir,
                    'jenis_kelamin'  => $req -> jenis_kelamin,
                    'alamat'         => $req -> alamat,
                    'no_telepon'     => $req -> no_telepon,
                    'email'          => $req -> email,
                    'tanggal_masuk'  => $req -> tanggal_masuk,
                    'posisi'         => $req -> posisi,
                    'gaji'           => $req -> gaji,
                    'status_pegawai'   => $req -> status_pegawai,
                    'updated_at'     => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data pegawai berhasil diganti!','success');
                return redirect('/pembina/pegawai/');
            } else {
                Alert('Gagal', 'Data pegawai gagal diganti!','error');
                return redirect('/pembina/pegawai/');
            }
        } catch (\Exception $e) {
            Alert('Data pegawai gagal disimpan!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/pegawai/');
        }
    }

    public function deletePegawai($id) {
        $query = DB::table('pegawais')
            ->where('id_pegawai', $id)
            ->delete();

        if ($query) {
            Alert('Berhasil', 'Data pegawai berhasil dihapus!','success');
            return redirect('/pembina/pegawai');
        } else {
            Alert('Gagal', 'Data pegawai gagal dihapus!','error');
            return redirect('/pembina/pegawai');
        }
    }

    public function updateFotoPegawai(Request $req) {
        try {
            $this->validate($req,[
                'foto_pegawai'      => 'required|image|mimes:png,jpg,jpeg,webp'
            ]);

            $image = $req->file('foto_pegawai');
            $image -> storeAs('public/foto_pegawai', $image -> hashName());
            $query = DB::table('pegawais')
                ->where('id_pegawai', $req -> id_pegawai)
                ->update([
                    'id_pegawai'     => $req -> id_pegawai,
                    'foto_pegawai'   => $image -> hashName(),
                    'updated_at'     => Carbon::now('Asia/Jakarta'),
                ]);

            if ($query){
                Alert('Berhasil', 'Foto pegawai berhasil diganti!','success');
                return redirect('/pembina/pegawai/');
            }
        } catch (\Exception $e) {
            Alert('Gagal', 'Foto pegawai gagal diganti!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/pegawai/');
        }
    }
}
