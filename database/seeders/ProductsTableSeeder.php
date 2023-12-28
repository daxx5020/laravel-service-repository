<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'samsung s21 fe 5g',
                'category_id' => 2,
                'description' => 'A good phone',
                'price' => 35999.00,
                'image' => 'product_images/k74CnpYUfG0utZJ1O1Dgo9WAW5jBbbbx8QHN86OK.jpg',
                'created_at' => '2023-12-28 04:33:45',
                'updated_at' => '2023-12-28 04:33:45',
            ],
            [
                'id' => 2,
                'name' => 'iphone 15 pro max',
                'category_id' => 3,
                'description' => 'a good phone',
                'price' => 130000.00,
                'image' => 'product_images/zVDUR1V34XwMqfvdMfcbGOja3gCCFO2TSH6broTN.jpg',
                'created_at' => '2023-12-28 04:35:21',
                'updated_at' => '2023-12-28 04:35:21',
            ],
            [
                'id' => 3,
                'name' => 'iphone se',
                'category_id' => 3,
                'description' => 'a good phone',
                'price' => 25999.00,
                'image' => 'product_images/ADp8a532PzluhDiK8TvLTAJpBSWk0r8FfapJvm45.png',
                'created_at' => '2023-12-28 04:35:56',
                'updated_at' => '2023-12-28 04:35:56',
            ],
            [
                'id' => 4,
                'name' => 'Tshirt',
                'category_id' => 5,
                'description' => 'solid grey tshirt',
                'price' => 599.00,
                'image' => 'product_images/bZOZzIcdSJl4tnLmXQdN8WLegVqMlAZ5KIR2QdYO.jpg',
                'created_at' => '2023-12-28 04:38:19',
                'updated_at' => '2023-12-28 04:38:19',
            ],
            [
                'id' => 5,
                'name' => 'hoodie',
                'category_id' => 6,
                'description' => 'hoodie for men',
                'price' => 899.00,
                'image' => 'product_images/47YCbdWwSb2yW5t56gLa6guA4BLqjP830YRpft07.jpg',
                'created_at' => '2023-12-28 04:41:14',
                'updated_at' => '2023-12-28 04:41:14',
            ],
            [
                'id' => 6,
                'name' => 'bag',
                'category_id' => 7,
                'description' => 'black color bag',
                'price' => 1299.00,
                'image' => 'product_images/el9eQPvfhh3MpfgOQFUTcS7fst02tnRkfQbXjgmb.jpg',
                'created_at' => '2023-12-28 04:43:35',
                'updated_at' => '2023-12-28 04:45:54',
            ],
        ]);
    }
}
