<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function account($id) {
        $query  = DB::table('users')
            ->where('id', $id)
            ->get();

        $data = array(
            'dataAccount' => $query
        );

        return view('profile.accounts', $data);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $req){
        $this->validate($req,[
            'foto'=>'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        //upload image
        $image = $req->file('foto');
        $image -> storeAs('public/foto_akun', $image->hashName());

        $query = DB::table('users')
            ->where('id',$req -> id)
            ->update([
                'name'      => $req -> name,
                'email'     => $req -> email,
                'password'  => bcrypt ($req -> password),
                'no_hp'     => $req -> no_hp,
                'foto'      => $image -> hashName(),
            ]);

        if ($query){
            Alert('Sukses', 'Profil anda berhasil diganti!','success');
            return redirect('/settings');
        } else {
            Alert('Gagal', 'Profil anda gagal diganti!','error');
            return redirect('/settings');
        }
    }
}
