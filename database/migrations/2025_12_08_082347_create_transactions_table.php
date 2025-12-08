<?php
// database/migrations/2024_01_01_000001_create_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            
            // CORRECTION : Utilisez le bon nom de colonne
            $table->unsignedBigInteger('id_utilisateur');
            $table->unsignedBigInteger('id_contenu');
            
            $table->string('reference_fedapay')->unique();
            $table->string('reference_client')->nullable();
            $table->decimal('montant', 10, 2);
            $table->string('devise', 3)->default('XOF');
            $table->enum('statut', ['en_attente', 'payee', 'echouee', 'annulee'])->default('en_attente');
            $table->enum('mode_paiement', ['mobile_money', 'carte', 'autre'])->default('mobile_money');
            $table->string('operateur')->nullable()->comment('MTN, Moov, etc.');
            $table->json('donnees_transaction')->nullable();
            $table->json('donnees_webhook')->nullable();
            $table->timestamp('date_paiement')->nullable();
            $table->timestamp('expire_le')->nullable();
            $table->timestamps();
            
            // CORRECTION : Référencez la bonne table 'utilisateurs'
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('cascade');
            
            // Index
            $table->index(['id_utilisateur', 'id_contenu']);
            $table->index(['statut', 'expire_le']);
            $table->index('reference_fedapay');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};