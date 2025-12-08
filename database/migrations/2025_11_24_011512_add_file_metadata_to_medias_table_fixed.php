<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Vérifier chaque colonne individuellement avant de l'ajouter
        if (!Schema::hasColumn('medias', 'nom_original')) {
            Schema::table('medias', function (Blueprint $table) {
                $table->string('nom_original')->nullable()->after('chemin');
            });
        }
        
        if (!Schema::hasColumn('medias', 'taille')) {
            Schema::table('medias', function (Blueprint $table) {
                $table->integer('taille')->nullable()->after('nom_original');
            });
        }
        
        if (!Schema::hasColumn('medias', 'mime_type')) {
            Schema::table('medias', function (Blueprint $table) {
                $table->string('mime_type')->nullable()->after('taille');
            });
        }
        
        // NE PAS ajouter created_at et updated_at - ils existent déjà
    }

    public function down()
    {
        // Optionnel : vous pouvez garder les colonnes en rollback
        // Schema::table('medias', function (Blueprint $table) {
        //     $table->dropColumn(['nom_original', 'taille', 'mime_type']);
        // });
    }
};