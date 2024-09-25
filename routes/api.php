<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TotalAbsensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// For 'LoginActivity'
Route::post('login', [LoginController::class, 'login']);

// For 'HomeFragment', 'HistoryFragment', 'ProfileFragment'
Route::get('/profiles/{id_detail}',[ProfileController::class, 'index']);

// For 'HomeFragment'
Route::get('/count-hadir/{id_detail}', [TotalAbsensiController::class, 'countHadir']);
Route::get('/count-sakit/{id_detail}', [TotalAbsensiController::class, 'countSakit']);
Route::get('/count-izin/{id_detail}', [TotalAbsensiController::class, 'countIzin']);
Route::get('/count-alfa/{id_detail}', [TotalAbsensiController::class, 'countAlfa']);

// For 'HistoryFragment'
Route::get('/get-history', [HistoryController::class, 'getHistory']);

// For 'AbsensiFragment'
Route::post('/get-absensi', [AbsensiController::class, 'absensiMasuk']);
Route::post('/out-absensi', [AbsensiController::class, 'absensiKeluar']);
Route::post('/sakit-absensi', [AbsensiController::class, 'absensiSakit']);
Route::post('/izin-absensi', [AbsensiController::class, 'absensiIzin']);

// For 'EditActivity'
Route::post('/update-profile/{id_detail}', [ProfileController::class, 'editProfile']);
