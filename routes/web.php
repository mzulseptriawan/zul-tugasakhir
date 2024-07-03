<?php

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

});

Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('mbIndex');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/settings', [ProfileController::class, 'index'])->name('profileIndex');
    Route::get('/settings/{id}', [ProfileController::class, 'account'])->name('account');
    Route::post('/settings/update',[ProfileController::class, 'update'])->name('updateAccount');
});
