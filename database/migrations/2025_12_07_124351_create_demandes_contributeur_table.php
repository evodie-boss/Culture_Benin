<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demandes_contributeur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_utilisateur')->constrained('utilisateurs', 'id_utilisateur');
            $table->enum('statut', ['en_attente', 'validée', 'refusée'])->default('en_attente');
            $table->text('message')->nullable();
            $table->timestamp('traitee_le')->nullable();
            $table->timestamps();

            $table->unique('id_utilisateur'); // 1 demande à la fois
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes_contributeur');
    }
};