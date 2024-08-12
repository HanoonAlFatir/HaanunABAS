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
        // ID USER 1
        User::create([
            'name' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 2
        User::create([
            'name' => 'Reyga Marza Ramadhan',
            'email' => 'rey@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 3
        User::create([
            'name' => 'Satria Galam Pratama',
            'email' => 'sat@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 4
        User::create([
            'name' => 'Irma Naila Juwita',
            'email' => 'iruma@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 5
        User::create([
            'name' => 'Engkus Kusnadi',
            'email' => 'wali10pplg1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 6
        User::create([
            'name' => 'Himatul Munawaroh',
            'email' => 'wali11rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 7
        User::create([
            'name' => 'Ani Nuraeni',
            'email' => 'wali12rpl1@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 8
        User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 9
        User::create([
            'name' => 'Cahyadi',
            'email' => 'cahyadi@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'ortu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 10
        User::create([
            'name' => 'Asep',
            'email' => 'asep@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'ortu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ID USER 11
        User::create([
            'name' => 'Agus',
            'email' => 'agus@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'ortu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
