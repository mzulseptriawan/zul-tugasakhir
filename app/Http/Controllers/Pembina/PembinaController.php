<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    public function index() {
        return view('pembina.index');
    }
}
