<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Livreur extends Authenticatable
{

    use HasFactory,Notifiable;

    protected $fillable = [
        'nom','prenom','adresse','statut_livreur','cin_livreur', 'email','telephone','password','reclamation', 'admin_id', // clé étrangère
    ];

    public function colis()
    {
        return $this->hasMany(Colis::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
