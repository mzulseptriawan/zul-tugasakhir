<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function authenticated(Request $request, $user) {
        if ($user -> level == 1 ) {
            Alert('Berhasil', 'Anda telah login sebagai '. Auth::user() -> name ,'success');
            return redirect('/admin/dashboard');
        } else if ($user -> level == 2 && $user -> status == "Aktif") {
            Alert('Berhasil', 'Anda telah login sebagai '. Auth::user() -> name ,'success');
            return redirect('/home');
        } else if ($user -> level == 2 && $user -> status == "Tidak Aktif") {
            // Auth::logout();
            $request->session()->flush();
            // Session::flush();
            Alert('Akun di-nonaktifkan!', 'Silahkan hubungi Admin.' ,'error');
            return redirect('/');
        } else {
            Auth::logout();
            Alert('Gagal', 'Anda telah keluar, silahkan masuk kembali.' ,'error');
            return redirect('/')->route('login');
        }
    }
}
