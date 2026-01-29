<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Gaming Headsets
            [
                'category_id' => 1,
                'name' => 'HyperX Cloud II',
                'description' => '7.1 surround sound gaming headset with memory foam ear cushions',
                'price' => 99.99,
                'stock_quantity' => 50,
            ],
            [
                'category_id' => 1,
                'name' => 'SteelSeries Arctis 7',
                'description' => 'Wireless gaming headset with DTS Headphone:X v2.0',
                'price' => 149.99,
                'stock_quantity' => 30,
            ],
            
            // Gaming Keyboards
            [
                'category_id' => 2,
                'name' => 'Corsair K95 RGB Platinum',
                'description' => 'Mechanical gaming keyboard with Cherry MX switches',
                'price' => 199.99,
                'stock_quantity' => 25,
            ],
            [
                'category_id' => 2,
                'name' => 'Razer BlackWidow Elite',
                'description' => 'Mechanical gaming keyboard with Razer Green switches',
                'price' => 169.99,
                'stock_quantity' => 40,
            ],
            
            // Gaming Mice
            [
                'category_id' => 3,
                'name' => 'Logitech G502 HERO',
                'description' => 'High-performance gaming mouse with 25,600 DPI sensor',
                'price' => 79.99,
                'stock_quantity' => 60,
            ],
            [
                'category_id' => 3,
                'name' => 'Razer DeathAdder V2',
                'description' => 'Ergonomic gaming mouse with 20,000 DPI optical sensor',
                'price' => 69.99,
                'stock_quantity' => 55,
            ],
            
            // Controllers
            [
                'category_id' => 4,
                'name' => 'Xbox Wireless Controller',
                'description' => 'Official Xbox wireless controller compatible with PC',
                'price' => 59.99,
                'stock_quantity' => 45,
            ],
            [
                'category_id' => 4,
                'name' => 'PlayStation DualSense',
                'description' => 'PS5 DualSense controller with haptic feedback',
                'price' => 69.99,
                'stock_quantity' => 35,
            ],
            
            // Gaming Monitors
            [
                'category_id' => 5,
                'name' => 'ASUS ROG Swift PG279Q',
                'description' => '27-inch 1440p 165Hz IPS gaming monitor',
                'price' => 699.99,
                'stock_quantity' => 15,
            ],
            [
                'category_id' => 5,
                'name' => 'BenQ ZOWIE XL2546K',
                'description' => '24.5-inch 1080p 240Hz TN gaming monitor',
                'price' => 499.99,
                'stock_quantity' => 20,
            ],
            
            // Mouse Pads
            [
                'category_id' => 6,
                'name' => 'SteelSeries QcK XXL',
                'description' => 'Extra large gaming mouse pad (900mm x 400mm)',
                'price' => 39.99,
                'stock_quantity' => 80,
            ],
            [
                'category_id' => 6,
                'name' => 'Razer Goliathus Extended Chroma',
                'description' => 'RGB extended gaming mouse pad with soft surface',
                'price' => 59.99,
                'stock_quantity' => 70,
            ],
            
            // Gaming Chairs
            [
                'category_id' => 7,
                'name' => 'Secretlab Titan Evo 2022',
                'description' => 'Premium ergonomic gaming chair with lumbar support',
                'price' => 549.99,
                'stock_quantity' => 10,
            ],
            [
                'category_id' => 7,
                'name' => 'DXRacer Formula Series',
                'description' => 'Racing-style gaming chair with adjustable armrests',
                'price' => 399.99,
                'stock_quantity' => 12,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
