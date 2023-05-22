<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@ginastywedding.com',
            'is_admin' => true,
        ]);

        User::factory()
            ->has(Address::factory()->count(3))
            ->create([
                'name' => 'Anita Rahmawati',
                'email' => 'anitarahma1507@gmail.com',
                'is_admin' => false,
            ]);

        $categories = Category::factory(10)->create();

        Product::factory(100)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(2)->pluck('id')->toArray()
            );
        });
    }
}
