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
        public function logout(Request $request)
        {
            Auth::logout(); // Déconnecte l'utilisateur

            $request->session()->invalidate(); // Invalide la session
            $request->session()->regenerateToken(); // Régénère le token CSRF pour plus de sécurité

            return redirect('/login')->with('success', 'Vous avez été déconnecté avec succès.');
        }
        public function showProfil() {

            $livreur=Auth::guard('livreur')->user();//recupere le livreur connecter

            //On retourne la vue avec les données de l'admin
            return view('livreur.profil', compact('livreur'));
        }
        public function updateProfil(Request $request) {
        /** @var \App\Models\Livreur $livreur */
    // Récupérer le livreur authentifié
    $livreur = Auth::guard('livreur')->user();

    // Validation des données
    $validatedData = $request->validate([
        'email' => 'required|email|max:50|unique:livreurs,email,' . $livreur->id,
        'password' => 'nullable|string|min:8|max:255', // Le mot de passe peut être facultatif
    ]);

    // Préparer les données à mettre à jour
    $updateData = [
        'email' => $validatedData['email'],
    ];

    // Si un mot de passe est fourni, on l'ajoute aux données
        if (!empty($validatedData['password'])) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        // Mettre à jour le livreur
             $livreur->update($updateData);

            return redirect()->route('showDashLivreur')->with('success', 'Profil modifié avec succès.');
        }

}
