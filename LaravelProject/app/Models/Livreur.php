<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{

    protected $fillable = [
        'nom', 'email','password'
    ];

    public function colis()
    {
        return $this->hasMany(Coli::class);
    }
}
