<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@kodegakure.com',
             'is_admin' => true
         ]);

         User::factory()->create([
             'name' => 'Anita Rahmawati',
             'email' => 'anitarahma1507@gmail.com',
             'is_admin' => false
         ]);

         $this->call([
            CategorySeeder::class
         ]);
    }
}
