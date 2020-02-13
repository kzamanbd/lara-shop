<?php

use Illuminate\Database\Seeder;
use App\Admin;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoryTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(DivisionTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(UpazilaTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        Admin::create([
            'name' => 'Admin',
            'email' => 'login@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
        ]);
    }
}
