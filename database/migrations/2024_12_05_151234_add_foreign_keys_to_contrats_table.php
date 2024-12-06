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
        Schema::table('contrats', function (Blueprint $table) {
            // Ajout des colonnes vendeur_id et acheteur_id
            $table->unsignedBigInteger('vendeur_id')->nullable()->after('montant');
            $table->unsignedBigInteger('acheteur_id')->nullable()->after('vendeur_id');

            // Ajout des clés étrangères
            $table->foreign('vendeur_id')->references('id')->on('vendeurs')->onDelete('set null');
            $table->foreign('acheteur_id')->references('id')->on('acheteurs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrats', function (Blueprint $table) {
            // Suppression des clés étrangères
            $table->dropForeign(['vendeur_id']);
            $table->dropForeign(['acheteur_id']);

            // Suppression des colonnes
            $table->dropColumn('vendeur_id');
            $table->dropColumn('acheteur_id');
        });
    }
};
