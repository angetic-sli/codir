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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reunion_id')->constrained()->onDelete('cascade');
            $table->foreignId('activite_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->text('recommandations')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('livrable')->nullable();
            $table->enum('statut', ['A faire','En cours','Terminé','En retard'])->default('A faire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
