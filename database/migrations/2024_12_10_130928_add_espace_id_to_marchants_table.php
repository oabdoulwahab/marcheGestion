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
        Schema::table('marchants', function (Blueprint $table) {
            $table->unsignedBigInteger('espace_id')->nullable();  // ou 'unsignedInteger' selon votre besoin
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marchants', function (Blueprint $table) {
            $table->dropColumn('espace_id');
        });        
    }
};
