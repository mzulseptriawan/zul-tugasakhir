<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembinaController extends Controller
{
    public function index() {
        $data = array(
            'totalHadirAbsensi' => DB::table('absensis')->where('jenis_absensi', 'Hadir')->count(),
            'totalSakitAbsensi' => DB::table('absensis')->where('jenis_absensi', 'Sakit')->count(),
            'totalIzinAbsensi' => DB::table('absensis')->where('jenis_absensi', 'Izin')->count(),
            'totalAlfaAbsensi' => DB::table('absensis')->where('jenis_absensi', 'Alfa')->count()
        );

        return view('pembina.index', $data);
    }

    public function pbAccount() {
        return view('pembina.account');
    }

    public function pbSubmitAccount(Request $req) {
        try {
            $this->validate($req,[
                'foto_pegawai'      => 'required|image|mimes:png,jpg,jpeg,webp'
            ]);

            //upload image
            $image = $req->file('foto_pegawai');
            $image -> storeAs('public/foto_pegawai', $image -> hashName());
            $query = DB::table('pegawais')
                ->insert([
                    'id_pegawai'        => $req -> id_pegawai,
                    'id_detail'         => $req -> id_detail,
                    'nik'               => $req -> nik,
                    'nama_lengkap'      => $req -> nama_lengkap,
                    'tempat_lahir'      => $req -> tempat_lahir,
                    'tanggal_lahir'     => $req -> tanggal_lahir,
                    'jenis_kelamin'     => $req -> jenis_kelamin,
                    'alamat'            => $req -> alamat,
                    'no_telepon'        => $req -> no_telepon,
                    'email'             => $req -> email,
                    'tanggal_masuk'     => $req -> tanggal_masuk,
                    'posisi'            => $req -> posisi,
                    'gaji'              => $req -> gaji,
                    'status_pegawai'    => 'Aktif',
                    'foto_pegawai'      => $image -> hashName(),
                    'created_at'        => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data anda berhasil disimpan!','success');
                return redirect('/pembina/dashboard');
            } else {
                Alert('Gagal', 'Data anda gagal disimpan!','error');
                return redirect('/pembina/dashboard');
            }
        } catch (\Exception $e) {
            Alert('Data anda gagal disimpan!', 'Error: ' .$e -> getMessage(),'error');
            return redirect('/pembina/dashboard');
        }
    }

    public function pbDetailAccount($id) {
        $query  = DB::table('pegawais')
            ->where('id_detail', $id)
            ->get();

        $data = array(
            'detailAccount' => $query
        );

        return view ('pembina.accountDetail', $data);
    }

    public function pbUpdateAccount(Request $req) {
        try {
            $query = DB::table('pegawais')
                ->where('id_pegawai', $req -> id_pegawai)
                ->update([
                    'id_pegawai'          => $req -> id_pegawai,
                    'nik'                 => $req -> nik,
                    'nama_lengkap'        => $req -> nama_lengkap,
                    'tempat_lahir'        => $req -> tempat_lahir,
                    'tanggal_lahir'       => $req -> tanggal_lahir,
                    'jenis_kelamin'       => $req -> jenis_kelamin,
                    'alamat'              => $req -> alamat,
                    'no_telepon'          => $req -> no_telepon,
                    'email'               => $req -> email,
                    'tanggal_masuk'       => $req -> tanggal_masuk,
                    'posisi'              => $req -> posisi,
                    'gaji'                => $req -> gaji,
                    'updated_at'          => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data diri anda berhasil diganti!','success');
                return redirect('/pembina/dashboard/');
            } else {
                Alert('Gagal', 'Data diri anda gagal diganti!','error');
                return redirect('/pembina/dashboard/');
            }
        } catch (\Exception $e) {
            Alert('Data diri anda gagal disimpan!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/dashboard/');
        }
    }

    public function pbUpdateFotoAccount(Request $req) {
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
                Alert('Berhasil', 'Foto data diri anda berhasil diganti!','success');
                return redirect('/pembina/dashboard/');
            }
        } catch (\Exception $e) {
            Alert('Foto data diri anda gagal diganti!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/dashboard/');
        }
    }
}
