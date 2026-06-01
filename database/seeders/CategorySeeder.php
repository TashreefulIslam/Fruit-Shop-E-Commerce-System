<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Latest electronic devices and gadgets'
            ],
            [
                'name' => 'Fresh Fruits',
                'description' => 'Fresh and organic fruits from local farms'
            ],
            [
                'name' => 'Vegetables',
                'description' => 'Quality vegetables for your kitchen'
            ],
            [
                'name' => 'Dairy',
                'description' => 'Fresh dairy products'
            ],
            [
                'name' => 'Grains',
                'description' => 'Essential grains and cereals'
            ],
            [
                'name' => 'Spices',
                'description' => 'Premium quality spices'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
