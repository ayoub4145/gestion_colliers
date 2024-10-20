<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{

    protected $fillable = [
        'nom','prenom','adresse', 'email','telephone','password'
    ];

    public function colis()
    {
        return $this->hasMany(Coli::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
