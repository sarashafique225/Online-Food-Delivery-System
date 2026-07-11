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
        // This creates the 'tasks' table in your database
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary key
            
            // Add your custom columns here:
            $table->string('title'); 
            $table->text('description')->nullable();
            $table->boolean('is_completed')->default(false);
            
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This deletes the 'tasks' table if you rollback the migration
        Schema::dropIfExists('tasks');
    }
};