<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    public function user() {
        $data = array(
            'users' => DB::table('users')->get()
        );

        $title = 'Peringatan!';
        $text = "Anda yakin ingin menghapus pengguna ini? Tindakan anda tidak dapat dibatalkan!";
        confirmDelete($title, $text);
        return view('admin.user',$data);
    }

    public function add() {
        return view('admin.add');
    }

    public function submit(Request $req) {
        $this->validate($req,[
            'foto'      => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        //upload image
        $image = $req->file('foto');
        $image -> storeAs('public/foto_akun', $image -> hashName());
        $query = DB::table('users')
            ->insert([
                'id'         => $req -> id,
                'name'       => $req -> name,
                'email'      => $req -> email,
                'password'   => bcrypt ($req -> password),
                'no_hp'      => $req -> no_hp,
                'status'     => $req -> status,
                'foto'       => $image -> hashName(),
                'level'      => $req -> level,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ]);

        if($query){
            Alert('Berhasil', 'Data pengguna berhasil disimpan!','success');
            return redirect('/admin/users');
        } else {
            Alert('Gagal', 'Data pengguna gagal disimpan!','error');
            return redirect('/admin/users/add');
        }
    }

    public function delete($data) {
        $query = DB::table('users')
            ->where("id", $data)
            ->delete();

        if ($query) {
            Alert('Berhasil', 'Data pengguna berhasil dihapus!','success');
        } else {
            Alert('Gagal', 'Data pengguna gagal dihapus!','error');
        }
        return redirect('/admin/users');
    }

    public function edit($data) {
        $query = DB::table('users')
            ->where("id", $data)
            ->get();

        $data = array(
            'users' => $query
        );

        return view('admin.edit', $data);
    }

    public function update(Request $req) {
        $this->validate($req,[
            'foto'=>'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        //upload image
        $image = $req->file('foto');
        $image -> storeAs('public/foto_akun', $image->hashName());

        $query = DB::table('users')
            ->where('id',$req -> id)
            ->update([
                'name'       => $req -> name,
                'email'      => $req -> email,
                'password'   => bcrypt ($req -> password),
                'level'      => $req -> level,
                'no_hp'      => $req -> no_hp,
                'foto'       => $image -> hashName(),
                'updated_at' => Carbon::now('Asia/Jakarta'),
            ]);

        if ($query){
            Alert('Berhasil', 'Data pengguna berhasil diganti!','success');
            return redirect('/admin/users');
        } else {
            Alert('Gagal', 'Data pengguna gagal diganti!','error');
            return redirect('/admin/users');
        }
    }

    public function status(Request $req) {
        $user = DB::table('users')->where("id", $req->id)->first();

        if ($user) {
            $newStatus = $user->status == 'Aktif' ? 'Tidak Aktif' : 'Aktif';

            $query = DB::table('users')
                ->where("id", $req->id)
                ->update(['status' => $newStatus]);

            if ($query) {
                return response()->json(['success' => true, 'message' => 'Status admin berhasil diganti!', 'newStatus' => $newStatus]);
            } else {
                return response()->json(['success' => false, 'message' => 'Status admin gagal diganti!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        }
    }
}
