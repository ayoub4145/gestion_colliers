<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'Client';

    // Clé primaire
    protected $primaryKey = 'ID_Client';

    // Attributs mass-assignable
    protected $fillable = [
        'Nom',
        'Email',
        'Téléphone',
        'Adresse',
    ];

    // Relations
    public function colisEnvoyes()
    {
        return $this->hasMany(Colis::class, 'ID_Client_Expediteur');
    }

    public function colisRecus()
    {
        return $this->hasMany(Colis::class, 'ID_Client_Destinataire');
    }
}
