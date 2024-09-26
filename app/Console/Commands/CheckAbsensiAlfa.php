<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckAbsensiAlfa extends Command
{
    // Nama command yang akan dijalankan
    protected $signature = 'check:absensi-alfa';

    // Deskripsi command
    protected $description = 'Cek absensi dan menandakan "Alfa" jika pengguna tidak melakukan absensi di atas jam 9:00 AM';

    // Fungsi yang dijalankan oleh cron job
    public function handle()
    {
        $now = Carbon::now();
        $jamBatas = Carbon::createFromTimeString('09:00:00');
        $today = Carbon::now()->toDateString();

        // Jika waktu sekarang lebih dari pukul 09:00
        if ($now->gt($jamBatas)) {
            // Ambil semua pengguna internship yang belum absen hari ini
            $internshipsBelumAbsen = DB::table('internships')
                ->leftJoin('absensis', function ($join) use ($today) {
                    $join
                        ->on('internships.id_detail', '=', 'absensis.id_detail')
                        ->whereDate('absensis.tanggal_masuk', '=', $today);
                })
                ->whereNull('absensis.id_detail')
                ->select('internships.id_detail')
                ->get();

            // Tandai mereka sebagai "Alfa"
            foreach ($internshipsBelumAbsen as $internship) {
                DB::table('absensis')->insert([
                    'id_detail' => $internship->id_detail,
                    'tanggal_masuk' => $today,
                    'lokasi_masuk' => 'Alfa',
                    'jenis_absensi' => 'Alfa',
                    'jam_masuk' => 'Alfa',
                    'foto_masuk' => 'Alfa',
                    'keterangan' => 'Alfa',
                ]);
            }

            $this->info('Absensi alfa telah ditandai untuk pengguna yang tidak absen sebelum jam 09:00.');
        }
    }
}
