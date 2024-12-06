<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            values: [
            ['name' => 'Administrator', 'role' => '1', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin123123'), 'img' => 'images/users/admin.jpg',],
            ['name' => 'Kasir', 'role' => '2', 'email' => 'kasir@gmail.com', 'password' => Hash::make('kasir123123'), 'img' => 'images/users/kasir.jpg',],

            ],
        );
    }
}
