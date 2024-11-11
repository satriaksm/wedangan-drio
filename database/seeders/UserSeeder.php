<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Administrator',
                'role' => '1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123123123'), // jangan lupa ganti password
                'img' => 'images/users/fael.png',
            ]
        );

        // Jika ingin menambah beberapa user lagi, bisa tambahkan di sini
        // User::factory()->count(10)->create(); // contoh untuk data dummy
    }
}
