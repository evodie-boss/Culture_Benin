<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('id_event');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->dateTime('date_debut');
            $table->dateTime('date_fin')->nullable();
            $table->string('lieu');
            $table->foreignId('id_region')->nullable()->constrained('regions', 'id_region');
            $table->enum('type', ['fete', 'festival', 'ceremonie', 'concert', 'exposition'])->default('fete');
            $table->decimal('prix', 8, 2)->default(0); // 0 = gratuit
            $table->string('image')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};