<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
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
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => '13', 'total_price' => 152000, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => '1', 'total_price' => 2000, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => '3', 'total_price' => 15000, 'created_at' => '2024-01-01 12:00:00', 'updated_at' => '2024-01-01 12:00:00'],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => '4', 'total_price' => 52000, 'created_at' => '2024-01-01 12:00:00', 'updated_at' => '2024-01-01 12:00:00'],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 5, 'total_price' => 35000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 3, 'total_price' => 15000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 7, 'total_price' => 56000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 2, 'total_price' => 15000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 8, 'total_price' => 60000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 6, 'total_price' => 45000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 9, 'total_price' => 70000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 10, 'total_price' => 90000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 4, 'total_price' => 24000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 5, 'total_price' => 35000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 7, 'total_price' => 50000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 8, 'total_price' => 60000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 6, 'total_price' => 48000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 3, 'total_price' => 22000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 2, 'total_price' => 10000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 4, 'total_price' => 28000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 6, 'total_price' => 45000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 2, 'payment_method' => 'cash', 'total_items' => 9, 'total_price' => 80000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ['user_id' => 1, 'payment_method' => 'cash', 'total_items' => 5, 'total_price' => 30000, 'created_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365)), 'updated_at' => Carbon::create(2024, 1, 1)->addDays(rand(0, 365))],
            ],
        );
    }
}
