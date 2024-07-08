<?php
// database/factories/InternshipFactory.php
namespace Database\Factories;

use App\Models\Internship;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipFactory extends Factory
{
    protected $model = Internship::class;

    public function definition()
    {
        return [
            'id_detail' => 1, // Sesuaikan ini dengan ID yang valid dari tabel users
            'nik' => $this->faker->unique()->numerify('##########'),
            'nama_lengkap' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['Pria', 'Wanita']),
            'asal_instansi' => $this->faker->company,
            'alamat' => $this->faker->address,
            'no_telepon' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'tanggal_masuk' => $this->faker->date(),
            'posisi' => $this->faker->jobTitle,
            'status_internship' => 'Aktif',
            'foto_internship' => $this->faker->imageUrl()
        ];
    }
}
