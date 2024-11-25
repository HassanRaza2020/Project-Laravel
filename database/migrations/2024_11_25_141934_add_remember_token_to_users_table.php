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
        Schema::table('users', function (Blueprint $table) {
            $table->rememberToken()->after('password');  // Add 'remember_token' column after 'password' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('remember_token');  // Drop the 'remember_token' column
        });
    }
};