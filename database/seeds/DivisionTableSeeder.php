<?php

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create([
		    'id' => '1',
		    'name' => 'Barishal',
		    'bn_name' => 'বরিশাল',
		]);

		Division::create([
		    'id' => '2',
		    'name' => 'Chattogram',
		    'bn_name' => 'চট্টগ্রাম',
		]);

		Division::create([
		    'id' => '3',
		    'name' => 'Dhaka',
		    'bn_name' => 'ঢাকা',
		]);

		Division::create([
		    'id' => '4',
		    'name' => 'Khulna',
		    'bn_name' => 'খুলনা',
		]);

		Division::create([
		    'id' => '5',
		    'name' => 'Rajshahi',
		    'bn_name' => 'রাজশাহী',
		]);

		Division::create([
		    'id' => '6',
		    'name' => 'Rangpur',
		    'bn_name' => 'রংপুর',
		]);

		Division::create([
		    'id' => '7',
		    'name' => 'Sylhet',
		    'bn_name' => 'সিলেট',
		]);

		Division::create([
		    'id' => '8',
		    'name' => 'Mymensingh',
		    'bn_name' => 'ময়মনসিংহ',
		]);
    }
}
