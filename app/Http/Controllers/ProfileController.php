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
                'alamat'    => $req -> alamat,
                'no_hp'     => $req -> no_hp,
                'foto'      => $image -> hashName(),
            ]);

        if ($query){
            return redirect('/settings')->with('success','Data akun berhasil dirubah.');
        } else {
            return redirect('/settings')->with('error','Data akun gagal dirubah.');
        }
    }
}
