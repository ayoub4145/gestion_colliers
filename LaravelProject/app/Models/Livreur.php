<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'Livreur';

    // Clé primaire
    protected $primaryKey = 'ID_Livreur';

    // Attributs mass-assignable
    protected $fillable = [
        'Nom',
        'Email',
        'Téléphone',
        'Statut',
    ];

    // Relations
    public function colis()
    {
        return $this->hasMany(Colis::class, 'ID_Livreur');
    }
}

