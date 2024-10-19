<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom', 'email','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function colisEnvoyes()
    {
        return $this->hasMany(Coli::class, 'expediteur_id');
    }

    public function colisRecus()
    {
        return $this->hasMany(Coli::class, 'destinataire_id');
    }
}
