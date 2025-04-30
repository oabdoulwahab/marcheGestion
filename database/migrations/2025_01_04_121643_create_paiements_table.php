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

        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marchant_id')->constrained()->onDelete('cascade'); // Clé étrangère vers l'adhérent
            $table->foreignId('cotisation_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la cotisation
            $table->decimal('montant', 10, 2); // Montant du paiement
            $table->date('date_paiement'); // Date du paiement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
