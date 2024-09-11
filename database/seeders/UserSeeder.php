<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ([
            $user = new User,
            $user -> id_detail = 1,
            $user -> name = "Zul",
            $user -> email = "mzulfikarseptriawan@gmail.com",
            $user -> password = bcrypt('qwerty123'),
            $user -> level = 1,
            $user -> foto = "",
            $user -> no_hp = '089657784310',
            $user -> status = "Aktif",
            $user -> save()
        ]);

        ([
            $user = new User,
            $user -> id_detail = 2,
            $user -> name = "Admin",
            $user -> email = "admin@gmail.com",
            $user -> password = bcrypt('qwerty123'),
            $user -> level = 2,
            $user -> foto = "",
            $user -> no_hp = '089512093389',
            $user -> status = "Aktif",
            $user -> save(),
        ]);

        ([
            $user = new User,
            $user -> id_detail = 3,
            $user -> name = "Member",
            $user -> email = "member@gmail.com",
            $user -> password = bcrypt('qwerty123'),
            $user -> level = 3,
            $user -> foto = "",
            $user -> no_hp = '089512093389',
            $user -> status = "Aktif",
            $user -> save(),
        ]);
    }
}
