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
        Schema::table('espaces', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['secteur_id']);

            // Supprimer la colonne
            $table->dropColumn('secteur_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espaces', function (Blueprint $table) {
           // Ajouter à nouveau la colonne
           $table->unsignedBigInteger('secteur_id')->nullable();

           // Ajouter la clé étrangère à nouveau
           $table->foreign('secteur_id')->references('id')->on('secteurs')->onDelete('cascade');
        });
    }
};
