<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataInternshipController extends Controller {
    public function internship() {
        $query = array(
            'internship' => DB::table('internships')->get());

        $title = 'Peringatan!';
        $text = "Anda yakin ingin menghapus data ini? Tindakan anda tidak dapat dibatalkan!";
        confirmDelete($title, $text);

        return view('pembina.internship', $query);
    }

    public function detailInternship($id) {
        $internship = DB::table('internships')->where('id_internship', $id)->get();

        return response()->json($internship);
    }

    public function addInternship() {
        $usersDetail = DB::table('users')->where('level', '3')->get();
        $query = array(
            'idDetail' => $usersDetail,
        );

        return view('pembina.internshipAdd', $query);
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

    public function deleteInternship($id) {
        $query = DB::table('internships')
            ->where('id_internship', $id)
            ->delete();

        if ($query) {
            Alert('Berhasil', 'Data internship berhasil dihapus!','success');
            return redirect('/pembina/internship');
        } else {
            Alert('Gagal', 'Data internship gagal dihapus!','error');
            return redirect('/pembina/internship');
        }
    }

    public function editInternship($id) {
        $query = array(
            'internship' => DB::table('internships')->where('id_internship', $id)->get(),
            'idDetail' => DB::table('users')->where('level', '3')->get(),
            'nameDetail' => DB::table('internships')
                ->join('users', 'users.id_detail', '=', 'internships.id_detail')
                ->select('users.name', 'internships.id_detail')
                ->where('id_internship', $id)
                ->get(),
        );

        return view('pembina.internshipEdit', $query);
    }

    public function updateInternship(Request $req) {
        try {
            $query = DB::table('internships')
                ->where('id_internship', $req -> id_internship)
                ->update([
                    'id_internship'       => $req -> id_internship,
                    'id_detail'           => $req -> id_detail,
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
                Alert('Berhasil', 'Data internship berhasil diganti!','success');
                return redirect('/pembina/internship/');
            } else {
                Alert('Gagal', 'Data internship gagal diganti!','error');
                return redirect('/pembina/internship/');
            }
        } catch (\Exception $e) {
            Alert('Data internship gagal disimpan!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/internship/');
        }
    }

    public function updateFotoInternship(Request $req) {
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
                Alert('Berhasil', 'Foto internship berhasil diganti!','success');
                return redirect('/pembina/internship/');
            }
        } catch (\Exception $e) {
            Alert('Gagal', 'Foto internship gagal diganti!', 'Error: '.$e->getMessage(),'error');
            return redirect('/pembina/internship/');
        }
    }



}
