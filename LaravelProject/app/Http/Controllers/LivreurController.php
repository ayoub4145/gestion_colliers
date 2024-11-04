<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pour l'authentification
use Illuminate\Validation\ValidationException;
use App\Models\Livreur;


class LivreurController extends Controller
{
        public function showDash()
        {
            return view('livreur.dashboard');
        }

}
