<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'Colis';

    // Clé primaire
    protected $primaryKey = 'ID_Colis';

    // Attributs mass-assignable
    protected $fillable = [
        'ID_Client_Expediteur',
        'ID_Client_Destinataire',
        'Description',
        'Prix',
        'Date_Envoi',
        'Statut',
    ];

    // Relations
    public function expediteur()
    {
        return $this->belongsTo(Client::class, 'ID_Client_Expediteur');
    }

    public function destinataire()
    {
        return $this->belongsTo(Client::class, 'ID_Client_Destinataire');
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'ID_Livreur');
    }
}
