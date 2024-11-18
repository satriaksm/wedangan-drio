<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert(
            values: [
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => '13', 'total_price' => 152000],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => '1', 'total_price' => 2000],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => '3', 'total_price' => 15000],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => '4', 'total_price' => 52000],
            ],
        );
    }
}
