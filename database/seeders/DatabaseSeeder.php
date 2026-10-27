<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //Create the first test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        //Create the second test user
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password'
        ]);

        //Create the third test user
        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password'
        ]);

        // Run ProductSeeder
        $this->call(ProductSeeder::class);
    }
}
