<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'email','password'
    ];
// One admin can have many livreurs
public function livreurs()
{
    return $this->hasMany(Livreur::class);
}
}
