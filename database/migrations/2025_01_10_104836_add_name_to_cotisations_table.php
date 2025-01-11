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
        Schema::table('cotisations', function (Blueprint $table) {
            //
             // Ajouter la colonne `name`
             $table->string('name')->nullable()->after('id'); // `nullable()` permet de rendre la colonne facultative
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotisations', function (Blueprint $table) {
            //
             // Supprimer la colonne `name` si la migration est annulée
             $table->dropColumn('name');
        });
    }
};
