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
        Schema::create('cr_clienteles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date_passage');
            $table->string('objet')->nullable();
            $table->text('compte_rendu')->nullable();
            $table->text('actions_prevues')->nullable();
            $table->text('actions_realisees')->nullable(); // ✅ Ajouté
            $table->enum('statut', ['Planifié', 'Effectué', 'Annulé'])->default('Planifié');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cr_clienteles');
    }
};
