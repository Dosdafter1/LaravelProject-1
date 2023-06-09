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
        DB::table('products')
            ->insert([
                ['title'=>'Orange','price'=>0.5,'quantity'=>10,'category_id'=>1],
                ['title'=>'Apple','price'=>0.3,'quantity'=>30,'category_id'=>1],
                ['title'=>'Lemon','price'=>1,'quantity'=>25,'category_id'=>1]
            ]);
    }
}
