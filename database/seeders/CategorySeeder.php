<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category::factory()->create(['name' => 'Paket']);
        Category::factory()->create(['name' => 'Pelaminan']);
        Category::factory()->create(['name' => 'Meja']);
        Category::factory()->create(['name' => 'Kursi']);
        Category::factory()->create(['name' => 'Tenda']);
        Category::factory()->create(['name' => 'Tata Rias']);
        Category::factory()->create(['name' => 'Photography']);
    }
}
