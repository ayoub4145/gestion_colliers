<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use App\Models\Coli;
use App\Models\Livreur;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(ClientSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(LivreurSeeder::class);
        $this->call(ColisSeeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
