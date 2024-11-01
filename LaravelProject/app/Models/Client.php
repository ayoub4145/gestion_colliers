<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable
{
    use HasFactory;


    protected $fillable = [
        'nom','prenom','adresse','ville','cin', 'email','telephone','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function colisEnvoyes()
    {
        return $this->hasMany(Colis::class, 'expediteur_id');
    }

    public function colisRecus()
    {
        return $this->hasMany(Colis::class, 'destinataire_id');
    }
}
