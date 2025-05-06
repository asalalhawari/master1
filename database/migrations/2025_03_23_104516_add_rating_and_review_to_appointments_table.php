<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->integer('rating')->nullable(); // Store rating, e.g., 1-5 scale
            $table->text('review')->nullable(); // Store the user's review
        });
    }
    
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['rating', 'review']);
        });
    }
    
};
