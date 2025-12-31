// database/migrations/xxxx_xx_xx_xxxxxx_create_market_user_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('market_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('market_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('market_role')->default('user'); // admin, manager, user
            $table->timestamps();
            
            // Empêche un utilisateur d'être deux fois dans le même marché
            $table->unique(['market_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('market_user');
    }
};