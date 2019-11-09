<?php

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
	        'name' => 'Laptops',
	        'slug' => 'laptops',
	    ]);
	    
	    Category::create([
	        'name' => 'Smartphone',
	        'slug' => 'smartphone',
	    ]);

	    Category::create([
	        'name' => 'Accessories',
	        'slug' => 'accessories',
	    ]);

	    Category::create([
	        'name' => 'Software',
	        'slug' => 'software',
	    ]);
    }
}
