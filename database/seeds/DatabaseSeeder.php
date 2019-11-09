<?php

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
        $this->call(CategoryTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(DivisionTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(UpazilaTableSeeder::class);
        $this->call(SettingsTableSeeder::class);

    }
}
