<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColisTable extends Migration
{
    public function up()
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->id('ID_Colis');
            $table->foreignId('ID_Client_Expediteur')->constrained('clients')->onDelete('cascade');
            $table->foreignId('ID_Client_Destinataire')->constrained('clients')->onDelete('cascade');
            $table->text('Description')->nullable();
            $table->decimal('Prix', 8, 2);
            $table->timestamp('Date_Envoi')->useCurrent();
            $table->enum('Statut', ['en attente', 'en cours', 'livré'])->default('en attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colis');
    }
}
