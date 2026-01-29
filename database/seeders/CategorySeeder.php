<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Gaming Headsets',
                'description' => 'High-quality gaming headsets with surround sound and noise cancellation',
            ],
            [
                'name' => 'Gaming Keyboards',
                'description' => 'Mechanical and membrane keyboards designed for gaming',
            ],
            [
                'name' => 'Gaming Mice',
                'description' => 'Precision gaming mice with customizable DPI and RGB lighting',
            ],
            [
                'name' => 'Controllers',
                'description' => 'Game controllers for PC and console gaming',
            ],
            [
                'name' => 'Gaming Monitors',
                'description' => 'High refresh rate monitors for competitive gaming',
            ],
            [
                'name' => 'Mouse Pads',
                'description' => 'Extended and RGB gaming mouse pads',
            ],
            [
                'name' => 'Gaming Chairs',
                'description' => 'Ergonomic gaming chairs for comfort during long sessions',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
