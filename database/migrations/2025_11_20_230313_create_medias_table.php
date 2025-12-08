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
    Schema::create('medias', function (Blueprint $table) {
        $table->id('id_media');
        $table->string('chemin');
        $table->text('description')->nullable();

        // FKs
        $table->unsignedBigInteger('id_contenu');
        $table->unsignedBigInteger('id_type_media')->nullable();

        $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('cascade');
        $table->foreign('id_type_media')->references('id_type_media')->on('type_medias')->onDelete('set null');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
