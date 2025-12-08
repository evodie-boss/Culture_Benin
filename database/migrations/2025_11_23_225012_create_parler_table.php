<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_region')->constrained('regions', 'id_region')->onDelete('cascade');
            $table->foreignId('id_langue')->constrained('langues', 'id_langue')->onDelete('cascade');
            $table->timestamps();
            
            // Clé unique pour éviter les doublons
            $table->unique(['id_region', 'id_langue']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('parler');
    }
};