<?php
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Gaming',
            'price' => 15000000,
        ]);
        Product::create([
            'name' => 'Macbook',
            'price' => 20000000,
        ]);
    }
}
