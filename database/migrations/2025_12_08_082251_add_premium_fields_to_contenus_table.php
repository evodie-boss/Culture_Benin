<?php
// database/migrations/2024_01_01_000000_add_premium_fields_to_contenus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->enum('type_acces', ['gratuit', 'payant'])->default('gratuit');
            $table->decimal('prix', 10, 2)->default(0);
            $table->string('devise', 3)->default('XOF');
            $table->boolean('est_premium')->default(false);
            $table->string('duree_acces', 50)->nullable()->comment('Ex: 24h, 7j, 30j, illimité');
            $table->text('apercu')->nullable()->comment('Texte d\'aperçu pour contenus payants');
        });
    }

    public function down(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->dropColumn([
                'type_acces',
                'prix',
                'devise',
                'est_premium',
                'duree_acces',
                'apercu'
            ]);
        });
    }
};