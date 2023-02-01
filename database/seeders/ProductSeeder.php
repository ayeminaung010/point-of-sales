<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'women pic',
            'image' => '63d8cfec67159_women3.png',
            'category_id' => 3,
            'description' => 'hi hello',
            'price' => 5000,
            'waiting_time' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            'name' => 'daung pic',
            'image' => '63d8d024ab315_men2.jpg',
            'category_id' => 4,
            'description' => 'hi hello',
            'price' => 10000,
            'waiting_time' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
