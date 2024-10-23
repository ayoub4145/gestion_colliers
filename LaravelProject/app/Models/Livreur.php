<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{

    use HasFactory;

    protected $fillable = [
        'nom','prenom','adresse','statut_livreur','cin', 'email','telephone','password', 'admin_id', // clé étrangère

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
