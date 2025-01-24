<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Database\Factories\ShopFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ShopTableSeeder::class,
            ProductTableSeeder::class,
            // OrdersTableSeeder::class,
            // AddressTableSeeder::class,
            ProdcatTableSeeder::class,

        ]);
        // User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Shop::factory(10)->admin()->create();
    }
}
