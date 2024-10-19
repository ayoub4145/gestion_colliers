<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LivreurController extends Controller
{
        // Affiche le formulaire de connexion
        // Affiche le formulaire de connexion
        public function showDash()
        {
            return view('livreur.dashboard');
        }

}
