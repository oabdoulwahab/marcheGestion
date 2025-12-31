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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant_total', 10, 2); // Montant total de la cotisation
            $table->date('date_debut'); // Date de début de la cotisation
            $table->date('date_fin'); // Date de fin de la cotisation
            $table->foreignId('market_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
