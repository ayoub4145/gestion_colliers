<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $fillable = [
        'email','password'
    ];
// One admin can have many livreurs
public function livreurs()
{
    return $this->hasMany(Livreur::class);
}
}
