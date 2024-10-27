<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;



class AdminController extends Controller
{
        // Affiche le formulaire de connexion
        public function showDash()
        {
            // $liste_livreurs=Livreur::where('statut_livreur','Disponible')->paginate(10);
            $liste_livreurs=Livreur::paginate(10);
            $liste_colis=Colis::paginate(10);
            // dd($liste_colis);
            // dd($liste_livreurs); // Cela va afficher les données retournées et arrêter l'exécution
            return view('admin.dashboard',compact('liste_livreurs','liste_colis'));
        }

}
