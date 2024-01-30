<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'item_name' => 'Beras Raja Lele',
                'weight'    => 5,
                'price'     => 75000,
                'stock_quantity' => 50,
                'image'     => 'beras.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'item_name' => 'Beras Pinkan',
                'weight'    => 10,
                'price'     => 180000,
                'stock_quantity' => 50,
                'image'     => 'beras2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
