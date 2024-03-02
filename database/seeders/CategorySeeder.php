<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            [
                'id'    => 1,
                'name'  => 'Cutlery',
                'slug'  => 'cutlery',
                "user_id" => 1,
            ],
            [
                'id'    => 2,
                'name'  => 'Crockery',
                'slug'  => 'crockery',
                "user_id" => 1,

            ],
            [
                'id'    => 3,
                'name'  => 'Cookware',
                'slug'  => 'cookware',
                "user_id" => 1,

            ],
            [
                'id'    => 4,
                'name'  => 'Greens',
                'slug'  => 'greens',
                "user_id" => 1,

            ],
            [
                'id'    => 5,
                'name'  => 'Flour',
                'slug'  => 'flour',
                "user_id" => 1,

            ]
        ]);

        $categories->each(function ($category) {
            Category::insert($category);
        });
    }
}
