<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $datas = [
            [
                'name' => "women's fashion",
                'image' => '63d8cfec67159_women3.png',
                'category_id' => 3,
                'description' => 'Cottonfield Women Print T-shirt',
                'price' => 5000,
                'waiting_time' => 5,
            ],
            [
                'name' => "man's fashion",
                'image' => '63d8d024ab315_men2.jpg',
                'category_id' => 4,
                'description' => 'Playboy bkk hoodies (free size)',
                'price' => 10000,
                'waiting_time' => 5,
            ],
            [
                'name' => "auto motive fun",
                'image' => 'automotive1.jpg',
                'category_id' => 2,
                'description' => 'Playboy bkk fun',
                'price' => 30000,
                'waiting_time' => 5,
            ],
            [
                'name' => "Apple iPhone 13 128GB",
                'image' => 'Apple iPhone 13 128GB.jpg',
                'category_id' => 2,
                'description' => 'Apple Brand',
                'price' => 30000,
                'waiting_time' => 5,
            ],
            [
                'name' => "Delicious Food for breakfast",
                'image' => 'breakfast2.jpg',
                'category_id' => 7,
                'description' => 'Delicious Food for breakfast',
                'price' => 3000,
                'waiting_time' => 5,
            ],
            [
                'name' => "New Design phone holder",
                'image' => 'New Design phone holder.png',
                'category_id' => 2,
                'description' => 'Phone Holder',
                'price' => 20000,
                'waiting_time' => 5,
            ],
        ];

        foreach($datas as $data){
            DB::table('products')->insert([
                'name' => $data['name'],
                'image' => $data['image'],
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'price' => $data['price'],
                'waiting_time' => $data['waiting_time'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
