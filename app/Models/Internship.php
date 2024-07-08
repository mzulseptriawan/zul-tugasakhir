<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id_internship';

    // Tentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_detail',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_instansi',
        'alamat',
        'no_telepon',
        'email',
        'tanggal_masuk',
        'posisi',
        'status_internship',
        'foto_internship',
    ];

    // Jika kolom 'foto_internship' nullable, tambahkan ke properti $casts untuk memastikan null dapat diterima
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'foto_internship' => 'string',
    ];

    // Definisikan relasi jika ada
    public function user()
    {
        return $this->belongsTo(User::class, 'id_detail', 'id_detail');
    }
}
