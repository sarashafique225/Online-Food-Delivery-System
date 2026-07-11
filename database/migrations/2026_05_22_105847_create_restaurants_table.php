<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('restaurants', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->string('address');
        $table->string('city')->default('Lahore');
        $table->string('phone')->nullable();
        $table->string('image')->nullable();
        $table->decimal('rating', 3, 2)->default(0.00);
        $table->boolean('is_open')->default(true);
        $table->boolean('eco_friendly')->default(false);
        $table->string('opening_time')->default('09:00');
        $table->string('closing_time')->default('23:00');
        $table->integer('delivery_time')->default(30);
        $table->decimal('delivery_fee', 8, 2)->default(0.00);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
