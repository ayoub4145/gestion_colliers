<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{

    use HasFactory;

    protected $fillable = [
        'nom','prenom','adresse','statut_livreur', 'email','telephone','password'
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
