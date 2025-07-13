<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_new_arrival')->default(false);
            $table->boolean('is_best_selling')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_special_offer')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_new_arrival', 'is_best_selling', 'is_featured', 'is_special_offer']);
        });
    }
};
