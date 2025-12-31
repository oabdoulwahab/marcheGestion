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
        Schema::create('acheteurs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'acheteur
            $table->string('phone')->unique(); // Téléphone de l'acheteur
            $table->string('email')->nullable(); // Email (optionnel)
            $table->string('activite')->nullable(); // Activité exercée
            $table->string('addresse')->nullable(); // Adresse (optionnel)
            $table->foreignId('market_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acheteurs');
    }
};
