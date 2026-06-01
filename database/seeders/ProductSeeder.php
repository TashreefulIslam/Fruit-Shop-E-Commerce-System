<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Fresh Fruits
            [
                'category_id' => 2,
                'name' => 'Fresh Apples',
                'price' => 150,
                'description' => 'Crispy and sweet apples fresh from the farm',
                'stock' => 50,
                'image' => null
            ],
            [
                'category_id' => 2,
                'name' => 'Organic Bananas',
                'price' => 80,
                'description' => 'Perfectly ripe organic bananas',
                'stock' => 80,
                'image' => null
            ],
            [
                'category_id' => 2,
                'name' => 'Juicy Oranges',
                'price' => 120,
                'description' => 'Sweet and juicy oranges loaded with vitamin C',
                'stock' => 60,
                'image' => null
            ],
            [
                'category_id' => 2,
                'name' => 'Strawberries',
                'price' => 200,
                'description' => 'Fresh red strawberries, sweet and delicious',
                'stock' => 35,
                'image' => null
            ],
            [
                'category_id' => 2,
                'name' => 'Mangoes',
                'price' => 180,
                'description' => 'King of fruits - sweet, juicy mangoes',
                'stock' => 45,
                'image' => null
            ],
            [
                'category_id' => 2,
                'name' => 'Watermelon',
                'price' => 250,
                'description' => 'Refreshing watermelon perfect for summer',
                'stock' => 30,
                'image' => null
            ],
            // Vegetables
            [
                'category_id' => 3,
                'name' => 'Fresh Carrots',
                'price' => 60,
                'description' => 'Crispy orange carrots full of nutrients',
                'stock' => 100,
                'image' => null
            ],
            [
                'category_id' => 3,
                'name' => 'Tomatoes',
                'price' => 50,
                'description' => 'Ripe and juicy tomatoes',
                'stock' => 120,
                'image' => null
            ],
            [
                'category_id' => 3,
                'name' => 'Broccoli',
                'price' => 90,
                'description' => 'Fresh green broccoli rich in vitamins',
                'stock' => 40,
                'image' => null
            ],
            [
                'category_id' => 3,
                'name' => 'Spinach',
                'price' => 70,
                'description' => 'Organic fresh spinach leaves',
                'stock' => 50,
                'image' => null
            ],
            // Dairy
            [
                'category_id' => 4,
                'name' => 'Cow Milk',
                'price' => 60,
                'description' => 'Fresh and pure cow milk',
                'stock' => 200,
                'image' => null
            ],
            [
                'category_id' => 4,
                'name' => 'Cheese',
                'price' => 300,
                'description' => 'Premium quality cheese',
                'stock' => 25,
                'image' => null
            ],
            [
                'category_id' => 4,
                'name' => 'Yogurt',
                'price' => 80,
                'description' => 'Creamy probiotic yogurt',
                'stock' => 60,
                'image' => null
            ],
            // Grains
            [
                'category_id' => 5,
                'name' => 'Basmati Rice',
                'price' => 200,
                'description' => 'Premium basmati rice',
                'stock' => 150,
                'image' => null
            ],
            [
                'category_id' => 5,
                'name' => 'Wheat Flour',
                'price' => 80,
                'description' => 'Fine quality wheat flour',
                'stock' => 100,
                'image' => null
            ],
            // Spices
            [
                'category_id' => 6,
                'name' => 'Turmeric Powder',
                'price' => 150,
                'description' => 'Pure turmeric powder with health benefits',
                'stock' => 50,
                'image' => null
            ],
            [
                'category_id' => 6,
                'name' => 'Black Pepper',
                'price' => 200,
                'description' => 'Fresh ground black pepper',
                'stock' => 40,
                'image' => null
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
