<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id_pegawai';

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_detail',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'email',
        'tanggal_masuk',
        'posisi',
        'gaji',
        'status_pegawai',
        'foto_pegawai',
    ];

    // Jika kolom 'foto_pegawai' nullable, tambahkan ke properti $casts untuk memastikan null dapat diterima
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'foto_pegawai' => 'string',
    ];

    // Definisikan relasi jika ada
    public function user()
    {
        return $this->belongsTo(User::class, 'id_detail', 'id_detail');
    }
}
