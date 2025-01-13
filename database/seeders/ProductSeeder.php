<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Cappuccino',
                'price' => 28000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Americano',
                'price' => 20000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Espresso',
                'price' => 15000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 1,
            ],
            [
                'name' => 'Lemon Tea',
                'price' => 18000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 2,
            ],
            [
                'name' => 'Black Tea',
                'price' => 15000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 2,
            ],
            [
                'name' => 'Jasmine Tea',
                'price' => 19000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 2,
            ],
            [
                'name' => 'Churros',
                'price' => 22000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 3,
            ],
            [
                'name' => 'Super Fries',
                'price' => 25000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 3,
            ],
            [
                'name' => 'Nasi Ayam Cuka',
                'price' => 27000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 4,
            ],
            [
                'name' => 'Kulit Ayam Sambal Matah',
                'price' => 27000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 4,
            ],
            [
                'name' => 'Rawon',
                'price' => 37000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 4,
            ],
            [
                'name' => 'Mie Goreng',
                'price' => 22000,
                'total_stock' => 100,
                'is_active' => 1,
                'category_id'  => 4,
            ],
        ]);
    }
}