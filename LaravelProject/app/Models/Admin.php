<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email','password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
// One admin can have many livreurs
public function livreurs()
{
    return $this->hasMany(Livreur::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
