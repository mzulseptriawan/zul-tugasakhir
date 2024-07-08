<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_detail',
        'name',
        'email',
        'password',
        'no_hp',
        'foto',
        'level',
        'status'
    ];

    public static function booted()
    {
        static::creating(function ($user) {
            // Sementara set id_detail ke nilai dummy
            $user->id_detail = 0;
        });

        static::created(function ($user) {
            // Perbarui id_detail setelah user dibuat
            $user->id_detail = $user->id;
            $user->save();
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function internship()
    {
        return $this->hasMany(Internship::class, 'id_detail', 'id_detail');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_detail', 'id_detail');
    }
}
