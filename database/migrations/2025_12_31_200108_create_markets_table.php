<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du marché (ex: "Marché Central", "Marché Nord")
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable()->default('Maroc');
            $table->string('status')->default('active'); // active, inactive
            $table->json('settings')->nullable(); // Paramètres spécifiques
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('markets');
    }
};