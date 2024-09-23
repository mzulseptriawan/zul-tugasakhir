<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function absensiMasuk(Request $request)
    {
        $getIdDetail        = $request->id_detail;
        $name               = $request->nama_lengkap;
        $lokasiMasuk        = $request->lokasi_masuk;
        $keteranganAbsensi  = $request->keterangan;
        $tanggalMasuk       = date("Y-m-d");
        $jamMasuk           = date("H:i:s");

        // Check if the user has already checked in today
        $validateData = DB::table('absensis')
            ->where('tanggal_masuk', $tanggalMasuk)
            ->where('id_detail', $getIdDetail)
            ->count();

        if ($validateData > 0) {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Anda sudah melakukan absensi."
            ], 400);
        }

        // Handle the base64 encoded image
        if ($request->has('foto_masuk')) {
            $image          = $request->foto_masuk;
            $decodedImage   = base64_decode($image);
            $imageName      = time() . '_' . $name . '.jpg'; // Create unique filename
            $path           = 'public/api/uploads/foto_absensi/foto_masuk/';

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, 0777, true);
            }

            // Save image to storage
            $filePath = $path . $imageName;
            Storage::put($filePath, $decodedImage);

        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Foto absensi tidak boleh kosong."
            ], 400);
        }

        // Save attendance record in the database
        $getAbsensi = DB::table('absensis')->insert([
            'id_detail'     => $getIdDetail,
            'tanggal_masuk' => $tanggalMasuk,
            'jam_masuk'     => $jamMasuk,
            'foto_masuk'    => $imageName,
            'lokasi_masuk'  => $lokasiMasuk,
            'keterangan'    => $keteranganAbsensi,
            'created_at'    => Carbon::now(),
        ]);

        if ($getAbsensi) {
            return response()->json([
                "error" => FALSE,
                "success" => 1,
                "message" => "Data Absensi telah tercatat."
            ], 200);
        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Gagal menyimpan data absensi."
            ], 500);
        }
    }

    public function absensiKeluar(Request $request)
    {
        $getIdDetail        = $request->id_detail;
        $name               = $request->nama_lengkap;
        $lokasiKeluar       = $request->lokasi_keluar;
        $tanggalKeluar      = date("Y-m-d");
        $jamKeluar          = date("H:i:s");

        // Check if the user has already checked out today
        $validateData = DB::table('absensis')
            ->where('id_detail', $getIdDetail)
            ->where('tanggal_keluar', $tanggalKeluar) // menggunakan tanggalKeluar untuk memeriksa absensi masuk
            ->whereNotNull('jam_keluar') // memeriksa apakah jam_keluar sudah terisi
            ->count();

        if ($validateData > 0) {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Anda sudah melakukan absensi pulang."
            ], 400);
        }

        // Handle the base64 encoded image
        if ($request->has('foto_keluar')) {
            $image          = $request->foto_keluar;
            $decodedImage   = base64_decode($image);
            $imageName      = time() . '_' . $name . '.jpg'; // Create unique filename
            $path           = 'public/api/uploads/foto_absensi/foto_keluar/';

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, 0777, true);
            }

            // Save image to storage
            $filePath = $path . $imageName;
            Storage::put($filePath, $decodedImage);

        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Foto absensi keluar tidak boleh kosong."
            ], 400);
        }

        // Save attendance record in the database
        $getAbsensi = DB::table('absensis')
            ->where('id_detail', $getIdDetail)
            ->where('tanggal_masuk', $tanggalKeluar) // Memastikan tanggal yang sama
            ->update([
                'tanggal_keluar' => $tanggalKeluar,
                'jam_keluar'     => $jamKeluar,
                'foto_keluar'    => $imageName,
                'lokasi_keluar'  => $lokasiKeluar,
                'updated_at'     => Carbon::now(),
            ]);

        if ($getAbsensi) {
            return response()->json([
                "error" => FALSE,
                "success" => 1,
                "message" => "Data Absensi Keluar telah tercatat."
            ], 200);
        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Gagal menyimpan data absensi."
            ], 500);
        }
    }

    public function absensiSakit(Request $request)
    {
        $getIdDetail        = $request  ->  id_detail;
        $name               = $request  ->  nama_lengkap;
        $lokasiSakit        = $request  ->  lokasi_masuk;
        $keteranganAbsensi  = $request  ->  keterangan;
        $tanggalSakit       = date("Y-m-d");
        $jamSakit           = date("H:i:s");

        // Check if the user has already checked in today
        $validateData = DB::table('absensis')
            ->where('tanggal_masuk', $tanggalSakit)
            ->where('id_detail', $getIdDetail)
            ->count();

        if ($validateData > 0) {
            return response()->json([
                "error"   => TRUE,
                "success" => 0,
                "message" => "Anda sudah melakukan pengajuan sakit."
            ], 400);
        }

        // Handle the base64 encoded image
        if ($request -> has('foto_masuk')) {
            $image          = $request -> foto_masuk;
            $decodedImage   = base64_decode($image);
            $imageName      = time() . '_' . $name . '.jpg'; // Create unique filename
            $path           = 'public/api/uploads/foto_absensi/foto_sakit/';

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, 0777, true);
            }

            // Save image to storage
            $filePath = $path . $imageName;
            Storage::put($filePath, $decodedImage);

        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Foto Keterangan Sakit tidak boleh kosong."
            ], 400);
        }

        // Save attendance record in the database
        $getAbsensi = DB::table('absensis')->insert([
            'id_detail'     => $getIdDetail,
            'tanggal_masuk' => $tanggalSakit,
            'jam_masuk'     => $jamSakit,
            'foto_masuk'    => $imageName,
            'lokasi_masuk'  => $lokasiSakit,
            'keterangan'    => $keteranganAbsensi,
            'jenis_absensi' => "Sakit",
            'created_at'    => Carbon::now(),
        ]);

        if ($getAbsensi) {
            return response()->json([
                "error" => FALSE,
                "success" => 1,
                "message" => "Data Sakit telah tercatat."
            ], 200);
        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Gagal menyimpan data sakit."
            ], 500);
        }
    }

    public function absensiIzin(Request $request)
    {
        $getIdDetail        = $request  ->  id_detail;
        $name               = $request  ->  nama_lengkap;
        $lokasiIzin         = $request  ->  lokasi_masuk;
        $keteranganAbsensi  = $request  ->  keterangan;
        $tanggalIzin        = date("Y-m-d");
        $jamIzin            = date("H:i:s");

        // Check if the user has already checked in today
        $validateData = DB::table('absensis')
            ->where('tanggal_masuk', $tanggalIzin)
            ->where('id_detail', $getIdDetail)
            ->count();

        if ($validateData > 0) {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Anda sudah melakukan pengajuan izin."
            ], 400);
        }

        // Handle the base64 encoded image
        if ($request -> has('foto_masuk')) {
            $image          = $request -> foto_masuk;
            $decodedImage   = base64_decode($image);
            $imageName      = time() . '_' . $name . '.jpg'; // Create unique filename
            $path           = 'public/api/uploads/foto_absensi/foto_izin/';

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path, 0777, true);
            }

            // Save image to storage
            $filePath = $path . $imageName;
            Storage::put($filePath, $decodedImage);

        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Foto Pengajuan Izin tidak boleh kosong."
            ], 400);
        }

        // Save attendance record in the database
        $getAbsensi = DB::table('absensis')->insert([
            'id_detail'     => $getIdDetail,
            'tanggal_masuk' => $tanggalIzin,
            'jam_masuk'     => $jamIzin,
            'foto_masuk'    => $imageName,
            'lokasi_masuk'  => $lokasiIzin,
            'keterangan'    => $keteranganAbsensi,
            'jenis_absensi' => "Izin",
            'created_at'    => Carbon::now(),
        ]);

        if ($getAbsensi) {
            return response()->json([
                "error" => FALSE,
                "success" => 1,
                "message" => "Data Izin telah tercatat."
            ], 200);
        } else {
            return response()->json([
                "error" => TRUE,
                "success" => 0,
                "message" => "Gagal menyimpan data izin."
            ], 500);
        }
    }

}
