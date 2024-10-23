<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pour l'authentification


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
        public function showForm(){
            return view('admin.ajouter_livreur_form');
        }
        public function ajouterLivreur(Request $request)
        {
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'adresse' => 'required|string',
                'statut' => 'required|string|in:Disponible,Occupé',
                'email' => 'required|email|unique:livreurs,email',
                'telephone' => 'required|string|max:10',
            ]);

            // Générer le mot de passe dynamique
            $password = Hash::make($request->prenom . '@' . $request->nom . '123');

            // Assigner l'admin_id à l'utilisateur connecté
            $adminId = 1; // Si l'utilisateur est connecté, sinon valeur par défaut 1

            Livreur::create([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'adresse' => $validatedData['adresse'],
                'statut_livreur' => $validatedData['statut'],
                'email' => $validatedData['email'],
                'telephone' => $validatedData['telephone'],
                'password' => $password,
                'admin_id' => $adminId,
            ]);

            return redirect()->route('showDashAdmin')->with('success', 'Livreur ajouté avec succès.');
        }



}
