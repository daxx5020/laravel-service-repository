<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'electronics',
                'parent_id' => null,
                'created_at' => '2023-12-28 03:16:27',
                'updated_at' => '2023-12-28 03:16:27',
            ],
            [
                'id' => 2,
                'name' => 'mobile',
                'parent_id' => 1,
                'created_at' => '2023-12-28 03:16:30',
                'updated_at' => '2023-12-28 03:17:45',
            ],
            [
                'id' => 3,
                'name' => 'IOS',
                'parent_id' => 2,
                'created_at' => '2023-12-28 03:16:38',
                'updated_at' => '2023-12-28 03:17:32',
            ],
            [
                'id' => 4,
                'name' => 'clothes',
                'parent_id' => null,
                'created_at' => '2023-12-28 03:16:44',
                'updated_at' => '2023-12-28 03:16:44',
            ],
            [
                'id' => 5,
                'name' => 'tshirts',
                'parent_id' => 4,
                'created_at' => '2023-12-28 03:16:51',
                'updated_at' => '2023-12-28 03:17:49',
            ],
            [
                'id' => 6,
                'name' => 'hoodie',
                'parent_id' => 4,
                'created_at' => '2023-12-28 03:16:54',
                'updated_at' => '2023-12-28 03:17:27',
            ],
            [
                'id' => 7,
                'name' => 'accesories',
                'parent_id' => null,
                'created_at' => '2023-12-28 03:40:55',
                'updated_at' => '2023-12-28 03:40:55',
            ],
            // Add more categories as needed
        ]);
    }
}
