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
    Schema::create('food_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
        $table->string('image')->nullable();
        $table->integer('calories')->default(0);
        $table->decimal('protein', 5, 2)->default(0);
        $table->decimal('carbs', 5, 2)->default(0);
        $table->decimal('fats', 5, 2)->default(0);
        $table->text('ingredients')->nullable();
        $table->boolean('is_healthy')->default(false);
        $table->boolean('is_available')->default(true);
        $table->string('meal_time')->default('all');
        $table->string('mood_tags')->nullable();
        $table->integer('prep_time')->default(20);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
