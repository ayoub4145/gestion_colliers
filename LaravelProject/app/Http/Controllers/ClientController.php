<?php

namespace App\Http\Controllers;

use App\Models\Coli;
use App\Models\Colis;
use Illuminate\Support\Str;
use App\Models\Client;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        public function ajouter_colis(Request $request) {
            try {
                $validatedData = $request->validate([
                    'description' => 'required|string|max:255',
                    'contenu_colis' => 'required|string|max:255',
                    'poids' => 'required|numeric',
                    'prix' => 'required|numeric',
                    'nom_destinataire' => 'required|string|max:50',
                    'prenom_destinataire' => 'required|string|max:50',
                    'adresse_destinataire' => 'required|string|max:255',
                    'telephone_destinataire' => 'required|string|max:20',
                ]);
            } catch (ValidationException $e) {
                // Afficher les erreurs de validation
                dd($e->errors());
            }

            // Générer un numéro de suivi unique
            $numeroSuivi = strtoupper(Str::random(10));

            // Vérifier si l'admin est connecté
            // $adminId = Auth::check() ? Auth::id() : null;

            // Insérer les informations du destinataire dans la table `clients`
            $destinataire = Client::create([
                'nom' => $validatedData['nom_destinataire'],
                'prenom' => $validatedData['prenom_destinataire'], // Remplir si nécessaire
                'adresse' => $validatedData['adresse_destinataire'],
                'ville' => $request->input('ville_destinataire', null), // Optionnel
                'cin' => Str::random(8), // CIN temporaire si non fourni
                'email' => $request->input('email_destinataire', null), // Optionnel
                'telephone' => $validatedData['telephone_destinataire'],
                'password' => Hash::make(Str::random(8)), // Mot de passe temporaire
            ]);

            // Insérer les informations du colis dans la table `colis`
            $colis = Colis::create([
                'numero_suivi' => $numeroSuivi,
                'description' => $validatedData['description'],
                'contenu_colis' => $validatedData['contenu_colis'],
                'poids' => $validatedData['poids'],
                'prix' => $validatedData['prix'],
                'expediteur_id' => Auth::id(), // ID de l'expéditeur connecté
                'destinataire_id' => $destinataire->id,
                'statut_colis' => 'En attente',
            ]);

            // Retourner une réponse ou rediriger
            return response()->json([
                'message' => 'Colis ajouté avec succès.',
                'colis' => $colis,
            ]);
        }

}
