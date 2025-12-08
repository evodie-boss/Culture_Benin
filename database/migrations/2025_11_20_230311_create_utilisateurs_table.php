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
    Schema::create('utilisateurs', function (Blueprint $table) {
        $table->id('id_utilisateur');
        $table->string('nom');
        $table->string('prenom')->nullable();
        $table->string('email')->unique();
        $table->string('mot_de_passe');
        $table->string('sexe')->nullable();
        $table->date('date_naissance')->nullable();
        $table->date('date_inscription')->nullable();
        $table->string('photo')->nullable();
        $table->string('statut')->default('actif');

        $table->unsignedBigInteger('id_role')->nullable();
        $table->unsignedBigInteger('id_langue')->nullable();

        $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('set null');
        $table->foreign('id_langue')->references('id_langue')->on('langues')->onDelete('set null');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
