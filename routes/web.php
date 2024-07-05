<?php

use App\Http\Controllers\Pembina\DataController;
use App\Http\Controllers\Pembina\PembinaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('adIndex');
    Route::get('/admin/users', [UserManagementController::class, 'user'])->name('adUser');
    // CRUD Users
    Route::get('/admin/users/add', [UserManagementController::class, 'add'])->name('adAdd');
    Route::post('/admin/users/submit', [UserManagementController::class, 'submit'])->name('adSubmit');
    Route::get('/admin/users/delete/{data}', [UserManagementController::class, 'delete'])->name('adDelete');
    Route::get('/admin/users/edit/{data}', [UserManagementController::class, 'edit'])->name('adEdit');
    Route::post('/admin/users/update', [UserManagementController::class, 'update'])->name('adUpdate');
    Route::post('/admin/users/status', [UserManagementController::class, 'status'])->name('adStatus');
});

Route::middleware(['auth', 'pembina'])->group(function () {
    Route::get('/pembina/dashboard', [PembinaController::class, 'index'])->name('pbIndex');
    Route::get('/pembina/pegawai', [DataController::class, 'pegawai'])->name('pbPegawai');
    Route::get('/pembina/internship', [PembinaController::class, 'index'])->name('pbInternship');
    // CRUD Pegawai
    Route::get('/pembina/pegawai/{id}', [DataController::class, 'detailPegawai'])->name('pbDetailPegawai');
    Route::get('/pembina/pegawai/add', [PembinaController::class, 'index'])->name('pbAddPegawai');
    Route::post('/pembina/pegawai/submit', [PembinaController::class, 'index'])->name('pbSubmitPegawai');
    Route::get('/pembina/pegawai/delete/{data}', [PembinaController::class, 'index'])->name('pbDeletePegawai');
    Route::get('/pembina/pegawai/edit/{data}', [PembinaController::class, 'index'])->name('pbEditPegawai');
    Route::post('/pembina/pegawai/update', [PembinaController::class, 'index'])->name('pbUpdatePegawai');
    // CRUD Internship
    Route::get('/pembina/internship/add', [PembinaController::class, 'index'])->name('pbAddInternship');
    Route::post('/pembina/internship/submit', [PembinaController::class, 'index'])->name('pbSubmitInternship');
    Route::get('/pembina/internship/delete/{data}', [PembinaController::class, 'index'])->name('pbDeleteInternship');
    Route::get('/pembina/internship/edit/{data}', [PembinaController::class, 'index'])->name('pbEditInternship');
    Route::post('/pembina/internship/update', [PembinaController::class, 'index'])->name('pbUpdateInternship');
});

Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('mbIndex');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings/{id}', [ProfileController::class, 'account'])->name('account');
    Route::post('/settings/update',[ProfileController::class, 'update'])->name('updateAccount');
});
