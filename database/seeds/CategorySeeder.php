<?php

use App\Category;
use Illuminate\Database\Seeder;
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
        Category::create([
            'title' => 'Programming',
            'slug' => Str::of('Programming')->slug('-'),
        ]);
        Category::create([
            'title' => 'Film',
            'slug' => Str::of('Film')->slug('-'),
        ]);
    }
}
