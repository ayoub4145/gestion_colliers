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
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('numero_suivi')->unique(); // Champ pour numéro de suivi unique
            $table->text('description');
            $table->string('contenu_colis');
            $table->unsignedBigInteger('expediteur_id');
            $table->unsignedBigInteger('destinataire_id');
            $table->unsignedBigInteger('livreur_id')->nullable();
            $table->enum('statut_colis',['En attente','En cours','Livré'])->default('En attente');
            $table->decimal('poids',8,2);
            $table->decimal('prix',8,2);
            $table->timestamp('date_livraison');
            $table->timestamp('date_reception')->nullable();
            $table->timestamps();

                        // Relations avec les clients et livreurs
            $table->foreign('expediteur_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('destinataire_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('livreur_id')->references('id')->on('livreurs')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
