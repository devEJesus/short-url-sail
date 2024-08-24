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
        Schema::create('url', function (Blueprint $table) {
            $table->id('id_url'); // Primary key
            $table->foreignId('id_user')->constrained('users', 'id')->onDelete('cascade'); // Foreign key to users table
            $table->text('long_url'); // Long URL column
            $table->string('short_url')->nullable()->unique(); // Short URL column, unique
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url');
    }
};
