<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                // Makanan (category_id = 1)
                ['name' => 'Nasi Kucing', 'category_id' => 1, 'selling_price' => 3000, 'purchase_price' => 1500, 'img' => 'nasi-kucing.png'],
                ['name' => 'Sate Puyuh', 'category_id' => 1, 'selling_price' => 4000, 'purchase_price' => 3000, 'img' => 'sate-puyuh.jpg'],
                ['name' => 'Sate Usus', 'category_id' => 1, 'selling_price' => 2000, 'purchase_price' => 1500, 'img' => 'sate-usus.jpg'],

                // Minuman (category_id = 2)
                ['name' => 'Teh', 'category_id' => 2, 'selling_price' => 3000, 'purchase_price' => 1200, 'img' => 'teh.png'],
                ['name' => 'Teh Kampul', 'category_id' => 2, 'selling_price' => 4000, 'purchase_price' => 2000, 'teh-kampul' => 'example1.png'],
                ['name' => 'Kopi', 'category_id' => 2, 'selling_price' => 4000, 'purchase_price' => 2000, 'img' => 'kopi.png'],

                // Gorengan (category_id = 3)
                ['name' => 'Tempe Goreng', 'category_id' => 3, 'selling_price' => 1000, 'purchase_price' => 500, 'img' => 'tempe-goreng.png'],

            ]
        );
    }
}

