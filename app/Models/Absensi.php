<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id_absensi';

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_detail',
        'jam_masuk',
        'jam_keluar',
        'tanggal_masuk',
        'tanggal_keluar',
        'lokasi_masuk',
        'lokasi_keluar',
        'jenis_absensi',
        'keterangan',
        'foto_masuk',
        'foto_keluar',
    ];

    // Jika ada kolom nullable, tambahkan ke properti $casts untuk memastikan null dapat diterima
    protected $casts = [
        'jam_keluar' => 'string',
        'tanggal_keluar' => 'string',
        'lokasi_keluar' => 'string',
        'foto_keluar' => 'string',
    ];

    // Definisikan relasi jika ada
    public function user()
    {
        return $this->belongsTo(User::class, 'id_detail', 'id_detail');
    }
}
