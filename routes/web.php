<?php

use App\Http\Controllers\Pembina\DataInternshipController;
use App\Http\Controllers\Pembina\DataPegawaiController;
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
    // CRUD Pegawai
    Route::get('/pembina/pegawai', [DataPegawaiController::class, 'pegawai'])->name('pbPegawai');
    Route::get('/pembina/pegawai/detail/{id}', [DataPegawaiController::class, 'detailPegawai'])->name('pbDetailPegawai');
    Route::get('/pembina/pegawai/add', [DataPegawaiController::class, 'addPegawai'])->name('pbAddPegawai');
    Route::post('/pembina/pegawai/submit', [DataPegawaiController::class, 'submitPegawai'])->name('pbSubmitPegawai');
    Route::get('/pembina/pegawai/delete/{id}', [DataPegawaiController::class, 'deletePegawai'])->name('pbDeletePegawai');
    Route::get('/pembina/pegawai/edit/{data}', [DataPegawaiController::class, 'editPegawai'])->name('pbEditPegawai');
    Route::post('/pembina/pegawai/update', [DataPegawaiController::class, 'updatePegawai'])->name('pbUpdatePegawai');
    Route::post('/pembina/pegawai/foto/update', [DataPegawaiController::class, 'updateFotoPegawai'])->name('pbUpdateFotoPegawai');
    // CRUD Internship
    Route::get('/pembina/internship', [DataInternshipController::class, 'internship'])->name('pbInternship');
    Route::get('/pembina/internship/detail/{id}', [DataInternshipController::class, 'detailInternship'])->name('pbDetailInternship');
    Route::get('/pembina/internship/add', [DataInternshipController::class, 'addInternship'])->name('pbAddInternship');
    Route::post('/pembina/internship/submit', [DataInternshipController::class, 'submitInternship'])->name('pbSubmitInternship');
    Route::get('/pembina/internship/delete/{id}', [DataInternshipController::class, 'deleteInternship'])->name('pbDeleteInternship');
    Route::get('/pembina/internship/edit/{data}', [DataInternshipController::class, 'editInternship'])->name('pbEditInternship');
    Route::post('/pembina/internship/update', [DataInternshipController::class, 'updateInternship'])->name('pbUpdateInternship');
    Route::post('/pembina/internship/foto/update', [DataInternshipController::class, 'updateFotoInternship'])->name('pbUpdateFotoInternship');

});

Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('mbIndex');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings/{id}', [ProfileController::class, 'account'])->name('account');
    Route::post('/settings/update',[ProfileController::class, 'update'])->name('updateAccount');
});
