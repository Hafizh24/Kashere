<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id'    => 1,
                'name' => 'Coffee',
                'slug' => 'coffee'
            ],
            [
                'id'    => 2,
                'name' => 'Tea',
                'slug' => 'tea'
            ],
            [
                'id'    => 3,
                'name' => 'Light Bites',
                'slug' => 'light-bites'
            ],
            [
                'id'    => 4,
                'name' => 'Indonesian Food',
                'slug' => 'indonesian-food'
            ],
        ]);
    }
}