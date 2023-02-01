<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'address' =>  'bago',
            'role' => 'admin',
            'gender' => 'male',
            'phone' => '0994874854',
            'password' => Hash::make('admin123')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'john aye',
            'email' => 'ayeminaung.mf@gmail.com',
            'address' =>  'bago',
            'role' => 'user',
            'gender' => 'female',
            'phone' => '092737373',
            'password' => Hash::make('ayeminaung.mf@gmail.com')
        ]);

        \App\Models\Product::factory()->create([
            'name' => 'women pic',
            'image' => '63d8cfec67159_women3.png',
            'category_id' => 3,
            'description' => 'hi hello',
            'price' => 5000,
            'waiting_time' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        \App\Models\Product::factory()->create([
            'name' => 'daung pic',
            'image' => '63d8d024ab315_men2.jpg',
            'category_id' => 4,
            'description' => 'hi hello',
            'price' => 10000,
            'waiting_time' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $this->call([
            CategorySeeder::class,
            // ProductSeeder::class,
        ]);
    }
}
