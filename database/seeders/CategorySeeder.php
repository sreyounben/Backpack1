<?php

namespace Database\Seeders;


use App\Models\API\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Book'
        ]);
        Category::create([
            'title' => 'Learn about english'
        ]);
        Category::create([
            'title' => 'Read book'
        ]);
    }
}
