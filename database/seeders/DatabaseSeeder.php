<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(CategoryTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(DivisionTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(UpazilaTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        User::create([
            'name' => 'Admin',
            'email' => 'login@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);
    }
}
