<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        $data = array(
            'totalPegawai' => DB::table('pegawais')->count(),
            'totalInternship' => DB::table('internships')->count(),
            'totalUsers' => DB::table('users')->count(),
            'users' => DB::table('users')->get(),
        );

        return view('admin.index', $data);
    }
}
