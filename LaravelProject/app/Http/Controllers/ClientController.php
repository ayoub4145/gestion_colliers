<?php

namespace App\Http\Controllers;

use App\Models\Coli;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
        // Affiche le formulaire de connexion
        public function showDash(Request $request)
        {

            // $nom_client;
            // $prenom_client;
            return view('client.dashboard');
        }

}
