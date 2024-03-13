<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("products")->insert([
            "name" => "Iphone 15",
            "price" => "70000",
        ]);
        DB::table("products")->insert([
            "name" => "Iphone 15 pro",
            "price" => "1100000",
        ]);
        DB::table("products")->insert([
            "name" => "Pixel 8",
            "price" => "45000",
        ]);
        DB::table("products")->insert([
            "name" => "Macbook air 13",
            "price" => "80000",
        ]);
        DB::table("products")->insert([
            "name" => "Macbook pro 14",
            "price" => "195000",
        ]);
        DB::table("products")->insert([
            "name" => "Macbook pro 160",
            "price" => "210000",
        ]);
    }
}
