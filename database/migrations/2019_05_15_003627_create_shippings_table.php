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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('customer_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('zip_code');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upazila_id');
            $table->string('address');
            $table->string('payment_type');
            $table->boolean('payment_status')->default(false);
            $table->string('shipping_method');
            $table->boolean('status')->default(false);
            $table->timestamps();
            //$table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
};
