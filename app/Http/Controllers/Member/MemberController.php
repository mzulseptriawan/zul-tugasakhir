<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index() {
        return view('member.index');
    }

    public function account() {
        return view('member.account');
    }

    public function submitAccount(Request $req) {
        try {
            $this->validate($req,[
                'foto_internship'      => 'required|image|mimes:png,jpg,jpeg,webp'
            ]);

            //upload image
            $image = $req->file('foto_internship');
            $image -> storeAs('public/foto_internship', $image -> hashName());
            $query = DB::table('internships')
                ->insert([
                    'id_internship'     => $req -> id_internship,
                    'id_detail'         => $req -> id_detail,
                    'nik'               => $req -> nik,
                    'nama_lengkap'      => $req -> nama_lengkap,
                    'tempat_lahir'      => $req -> tempat_lahir,
                    'tanggal_lahir'     => $req -> tanggal_lahir,
                    'asal_instansi'     => $req -> asal_instansi,
                    'jenis_kelamin'     => $req -> jenis_kelamin,
                    'alamat'            => $req -> alamat,
                    'no_telepon'        => $req -> no_telepon,
                    'email'             => $req -> email,
                    'tanggal_masuk'     => $req -> tanggal_masuk,
                    'posisi'            => $req -> posisi,
                    'status_internship' => 'Aktif',
                    'foto_internship'   => $image -> hashName(),
                    'created_at'        => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data anda berhasil disimpan!','success');
                return redirect('/member/dashboard');
            } else {
                Alert('Gagal', 'Data anda gagal disimpan!','error');
                return redirect('/member/dashboard');
            }
        } catch (\Exception $e) {
            Alert('Data anda gagal disimpan!', 'Error: Anda telah mengisi Identitas Diri, silahkan hubungi Admin/Pembina bila ada kesalahan.','error');
            return redirect('/member/dashboard');
        }
    }

    public function detailAccount($id) {
        $query  = DB::table('internships')
            ->where('id_detail', $id)
            ->get();

        $data = array(
            'detailAccount' => $query
        );

        return view ('member.accountDetail', $data);
    }

    public function submitInternship(Request $req) {
        try {
            $this->validate($req,[
                'foto_internship'      => 'required|image|mimes:png,jpg,jpeg,webp'
            ]);

            //upload image
            $image = $req->file('foto_internship');
            $image -> storeAs('public/foto_internship', $image -> hashName());
            $query = DB::table('internships')
                ->insert([
                    'id_internship'     => $req -> id_internship,
                    'nik'               => $req -> nik,
                    'nama_lengkap'      => $req -> nama_lengkap,
                    'tempat_lahir'      => $req -> tempat_lahir,
                    'tanggal_lahir'     => $req -> tanggal_lahir,
                    'asal_instansi'     => $req -> asal_instansi,
                    'jenis_kelamin'     => $req -> jenis_kelamin,
                    'alamat'            => $req -> alamat,
                    'no_telepon'        => $req -> no_telepon,
                    'email'             => $req -> email,
                    'tanggal_masuk'     => $req -> tanggal_masuk,
                    'posisi'            => $req -> posisi,
                    'status_internship' => 'Aktif',
                    'foto_internship'   => $image -> hashName(),
                    'created_at'        => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data internship berhasil disimpan!','success');
                return redirect('/pembina/internship');
            } else {
                Alert('Gagal', 'Data internship gagal disimpan!','error');
                return redirect('/pembina/internship/add');
            }
        } catch (\Exception $e) {
            Alert('Data internship gagal disimpan!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/internship/add');
        }
    }

    public function updateAccount(Request $req) {
        try {
            $query = DB::table('internships')
                ->where('id_internship', $req -> id_internship)
                ->update([
                    'id_internship'       => $req -> id_internship,
                    'nik'                 => $req -> nik,
                    'nama_lengkap'        => $req -> nama_lengkap,
                    'tempat_lahir'        => $req -> tempat_lahir,
                    'tanggal_lahir'       => $req -> tanggal_lahir,
                    'jenis_kelamin'       => $req -> jenis_kelamin,
                    'asal_instansi'       => $req -> asal_instansi,
                    'alamat'              => $req -> alamat,
                    'no_telepon'          => $req -> no_telepon,
                    'email'               => $req -> email,
                    'tanggal_masuk'       => $req -> tanggal_masuk,
                    'posisi'              => $req -> posisi,
                    'status_internship'   => $req -> status_internship,
                    'updated_at'          => Carbon::now('Asia/Jakarta'),
                ]);

            if($query){
                Alert('Berhasil', 'Data diri anda berhasil diganti!','success');
                return redirect('/member/dashboard/');
            } else {
                Alert('Gagal', 'Data diri anda gagal diganti!','error');
                return redirect('/member/dashboard/');
            }
        } catch (\Exception $e) {
            Alert('Data diri anda gagal disimpan!', 'Error: '.$e->getMessage(),'error');
            return redirect('/member/dashboard/');
        }
    }

    public function updateFotoAccount(Request $req) {
        try {
            $this->validate($req,[
                'foto_internship'      => 'required|image|mimes:png,jpg,jpeg,webp'
            ]);

            $image = $req->file('foto_internship');
            $image -> storeAs('public/foto_internship', $image -> hashName());
            $query = DB::table('internships')
                ->where('id_internship', $req -> id_internship)
                ->update([
                    'id_internship'     => $req -> id_internship,
                    'foto_internship'   => $image -> hashName(),
                    'updated_at'     => Carbon::now('Asia/Jakarta'),
                ]);

            if ($query){
                Alert('Berhasil', 'Foto data diri anda berhasil diganti!','success');
                return redirect('/member/dashboard/');
            }
        } catch (\Exception $e) {
            Alert('Gagal', 'Foto data diri anda gagal diganti!', 'Error: '.$e->getMessage(),'error');
            return redirect('/member/dashboard/');
        }
    }

}
