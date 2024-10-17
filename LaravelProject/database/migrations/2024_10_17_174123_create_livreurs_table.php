<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivreursTable extends Migration
{
    public function up()
    {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->id('ID_Livreur');
            $table->string('Nom');
            $table->string('Email')->unique();
            $table->string('Téléphone')->nullable();
            $table->enum('Statut', ['disponible', 'occupé'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('livreurs');
    }
}
