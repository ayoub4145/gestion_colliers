<?php

namespace App\Http\Controllers;

use App\Models\Coli;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
        // Affiche le formulaire de connexion
        public function showDash()
        {
            $liste_livreurs=Livreur::all();
            $liste_colis=Coli::all();
            return view('client.dashboard');
        }

}
