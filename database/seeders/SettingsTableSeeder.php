<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'phone' => '+8801716724245',
            'email' => 'kzamanbn@gmail.com',
            'address' => 'Mymensingh, Bangladesh',
            'about_us' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.',
            'created_at' => now(),
        ]);
    }
}
