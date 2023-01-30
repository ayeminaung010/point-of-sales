<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Health & Beauty',
            'Electronic Devices',
            'Electronic Accessories',
            'TV & Home Appliances',
            'Womens Fashion',
            'Mens Fashion',
            'Groceries & Pets',
            'Automotive & Motorbike',
            'Home & Lifestyle',
            'Babies & Toys',
            'Sports & Outdoor',
            'Watches & Accessories',
            'Food',
            'Pizza'
        ];
        foreach($categories as $category){
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
