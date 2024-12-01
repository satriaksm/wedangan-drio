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
            ['order_id' => 5, 'product_id' => 1, 'quantity' => 3, 'subtotal_price' => 15000],
            ['order_id' => 5, 'product_id' => 2, 'quantity' => 2, 'subtotal_price' => 10000],
            ['order_id' => 5, 'product_id' => 3, 'quantity' => 1, 'subtotal_price' => 3000],
            // Order 6
            ['order_id' => 6, 'product_id' => 4, 'quantity' => 3, 'subtotal_price' => 15000],
            ['order_id' => 6, 'product_id' => 5, 'quantity' => 3, 'subtotal_price' => 12000],
            ['order_id' => 6, 'product_id' => 1, 'quantity' => 1, 'subtotal_price' => 53000],
            // Order 7
            ['order_id' => 7, 'product_id' => 2, 'quantity' => 2, 'subtotal_price' => 8000],
            ['order_id' => 7, 'product_id' => 3, 'quantity' => 4, 'subtotal_price' => 12000],
            ['order_id' => 7, 'product_id' => 4, 'quantity' => 3, 'subtotal_price' => 15000],
            // Order 8
            ['order_id' => 8, 'product_id' => 3, 'quantity' => 4, 'subtotal_price' => 8000],
            ['order_id' => 8, 'product_id' => 5, 'quantity' => 3, 'subtotal_price' => 9000],
            // Order 9
            ['order_id' => 9, 'product_id' => 1, 'quantity' => 2, 'subtotal_price' => 53000],
            ['order_id' => 9, 'product_id' => 4, 'quantity' => 4, 'subtotal_price' => 20000],
            // Order 10
            ['order_id' => 10, 'product_id' => 2, 'quantity' => 3, 'subtotal_price' => 12000],
            ['order_id' => 10, 'product_id' => 3, 'quantity' => 4, 'subtotal_price' => 16000],
            // Order 11
            ['order_id' => 11, 'product_id' => 5, 'quantity' => 5, 'subtotal_price' => 15000],
            ['order_id' => 11, 'product_id' => 6, 'quantity' => 2, 'subtotal_price' => 6000],
            ['order_id' => 11, 'product_id' => 1, 'quantity' => 1, 'subtotal_price' => 53000],
            // Order 12
            ['order_id' => 12, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 6000],
            ['order_id' => 12, 'product_id' => 6, 'quantity' => 3, 'subtotal_price' => 9000],
            ['order_id' => 12, 'product_id' => 1, 'quantity' => 4, 'subtotal_price' => 21000],
            // Order 13
            ['order_id' => 13, 'product_id' => 2, 'quantity' => 3, 'subtotal_price' => 9000],
            ['order_id' => 13, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 6000],
            ['order_id' => 13, 'product_id' => 4, 'quantity' => 1, 'subtotal_price' => 3000],
            // Order 14
            ['order_id' => 14, 'product_id' => 3, 'quantity' => 1, 'subtotal_price' => 2000],
            ['order_id' => 14, 'product_id' => 5, 'quantity' => 5, 'subtotal_price' => 15000],
            // Order 15
            ['order_id' => 15, 'product_id' => 1, 'quantity' => 4, 'subtotal_price' => 21200],
            ['order_id' => 15, 'product_id' => 2, 'quantity' => 2, 'subtotal_price' => 8000],
            ['order_id' => 15, 'product_id' => 6, 'quantity' => 1, 'subtotal_price' => 3000],
            // Order 16
            ['order_id' => 16, 'product_id' => 1, 'quantity' => 1, 'subtotal_price' => 53000],
            ['order_id' => 16, 'product_id' => 3, 'quantity' => 3, 'subtotal_price' => 6000],
            ['order_id' => 16, 'product_id' => 5, 'quantity' => 2, 'subtotal_price' => 6000],
            // Order 17
            ['order_id' => 17, 'product_id' => 1, 'quantity' => 4, 'subtotal_price' => 21000],
            ['order_id' => 17, 'product_id' => 6, 'quantity' => 3, 'subtotal_price' => 9000],
            // Order 18
            ['order_id' => 18, 'product_id' => 2, 'quantity' => 3, 'subtotal_price' => 12000],
            ['order_id' => 18, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 6000],
            ['order_id' => 18, 'product_id' => 1, 'quantity' => 1, 'subtotal_price' => 53000],

            ['order_id' => 19, 'product_id' => 1, 'quantity' => 4, 'subtotal_price' => 21200],
            ['order_id' => 19, 'product_id' => 2, 'quantity' => 2, 'subtotal_price' => 8000],
            ['order_id' => 19, 'product_id' => 6, 'quantity' => 1, 'subtotal_price' => 3000],

            ['order_id' => 20, 'product_id' => 1, 'quantity' => 4, 'subtotal_price' => 21200],
            ['order_id' => 20, 'product_id' => 2, 'quantity' => 2, 'subtotal_price' => 8000],
            ['order_id' => 20, 'product_id' => 6, 'quantity' => 1, 'subtotal_price' => 3000],
            // Order 16
            ['order_id' => 21, 'product_id' => 1, 'quantity' => 1, 'subtotal_price' => 53000],
            ['order_id' => 21, 'product_id' => 3, 'quantity' => 3, 'subtotal_price' => 6000],
            ['order_id' => 21, 'product_id' => 5, 'quantity' => 2, 'subtotal_price' => 6000],
            // Order 17
            ['order_id' => 22, 'product_id' => 1, 'quantity' => 4, 'subtotal_price' => 21000],
            ['order_id' => 22, 'product_id' => 6, 'quantity' => 3, 'subtotal_price' => 9000],
            // Order 18
            ['order_id' => 23, 'product_id' => 2, 'quantity' => 3, 'subtotal_price' => 12000],
            ['order_id' => 23, 'product_id' => 3, 'quantity' => 2, 'subtotal_price' => 6000],
            ['order_id' => 23, 'product_id' => 1, 'quantity' => 1, 'subtotal_price' => 53000],
            ],
        );
    }
}
