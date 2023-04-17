<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Paket']);
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Pelaminan']);
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Meja']);
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Kursi']);
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Tenda']);
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Tata Rias']);
        Category::factory()->has(Product::factory()->count(rand(5, 10)))->create(['name' => 'Photography']);
    }
}
