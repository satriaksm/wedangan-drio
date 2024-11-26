<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_items')->insert(
            values: [
                //order 1
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2, 'subtotal_price' => 5000],
            ['order_id' => 1, 'product_id' => 2, 'quantity' => 4, 'subtotal_price' => 12000],
            ['order_id' => 1, 'product_id' => 3, 'quantity' => 1, 'subtotal_price' => 3000],
                //order 2
            ['order_id' => 2, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 3000],
            ['order_id' => 2, 'product_id' => 1, 'quantity' => 2, 'subtotal_price' => 53000],
            ['order_id' => 2, 'product_id' => 4, 'quantity' => 2, 'subtotal_price' => 2000],
            ['order_id' => 2, 'product_id' => 5, 'quantity' => 2, 'subtotal_price' => 3000],

            ['order_id' => 3, 'product_id' => 1, 'quantity' => 2, 'subtotal_price' => 53000],
            ['order_id' => 3, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 2000],
            ['order_id' => 3, 'product_id' => 6, 'quantity' => 2, 'subtotal_price' => 3000],

            ['order_id' => 4, 'product_id' => 1, 'quantity' => 2, 'subtotal_price' => 53000],
            ['order_id' => 4, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 2000],
            ],
        );
    }
}
