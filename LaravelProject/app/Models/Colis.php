<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coli extends Model
{
    protected $fillable = [
        'description', 
        'expediteur_id', 
        'destinataire_id', 
        'livreur_id', 
        'poids', 
        'prix', 
        'numero_suivi', 
        'date_livraison'
    ];

    public function expediteur()
    {
        return $this->belongsTo(Client::class, 'expediteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(Client::class, 'destinataire_id');
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'livreur_id');
    }
}
