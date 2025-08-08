<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*         $faker = Faker::create();

        for($i=0;$i<10;$i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'desc' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 10, 100),
                'stock' => $faker->numberBetween(0, 100),
                'published_at' => $faker->dateTimeBetween('-10 years', 'now'),
                'page_count' => $faker->numberBetween(1, 300),
                'cover_image' => $faker->imageUrl(200, 300, 'books', true), 
            ]);
        } */
  /*      for ($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
                'title' => Str::random(10),
                'author' => Str::random(10),
                'desc' => Str::random(50),
                'price' => rand(1000, 10000) / 100, // Generates a float between 10.00 and 100.00
                'stock' => rand(0, 100),
                'published_at' => now()->subDays(rand(0, 3650)), // Random date in the past 10 years
                'page_count' => rand(1, 300),
                'cover_image' => 'https://via.placeholder.com/200x300.png?text=Book+' . ($i + 1),
            ]);
        } */
    }
}
