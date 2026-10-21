<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some test products in the database
        Product::create([
            'name' => 'Laptop',
            'qty' => 5,
            'price' => 4999,
            'description' => 'A simple laptop'
        ]);

        Product::create([
            'name' => 'Mouse',
            'qty' => 10,
            'price' => 199,
            'description' => 'Wireless mouse'
        ]);

        Product::create([
            'name' => 'Keyboard',
            'qty' => 7,
            'price' => 399,
            'description' => 'Gaming keyboard'
        ]);
    }
}
