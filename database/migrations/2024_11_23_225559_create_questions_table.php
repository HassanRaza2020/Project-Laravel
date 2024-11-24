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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id'); // Primary key for the question
            $table->unsignedBigInteger('user_id'); // Foreign key for user ID
            $table->string('username'); // Username
            $table->string('title'); // Title of the question
            $table->text('description'); // Detailed description
            $table->unsignedBigInteger('content')->nullable(); // Content field
            $table->timestamps();

            // Add a foreign key constraint (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};