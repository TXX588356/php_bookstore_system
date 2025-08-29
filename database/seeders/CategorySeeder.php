<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Comics'],
            ['name' => 'Education'],
            ['name' => 'Fiction'],
            ['name' => 'Non-fiction'],
            ['name' => 'Childrens'],
            ['name' => 'Romance'],
            ['name' => 'Graphic Novels'],
            ['name' => 'Fantasy'],
            ['name' => 'Mystery'],
            ['name' => 'Biography'],
            ['name' => 'Adventure'],
            ['name' => 'Psychology'],
            ['name' => 'Business'],
            ['name' => 'Personal Development'],
            ['name' => 'Travel'],
        ]);
    }
}
