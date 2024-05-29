<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('product_price', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->string('product_color');
            $table->string('alert_quantity');
            $table->string('quantity');
            $table->text('description');
            $table->string('image');
            $table->boolean('status')->default(true);
            $table->boolean('sale_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        /*$table->dropForeign('category_id')->referances('id')->on('categories');*/
    }
};
