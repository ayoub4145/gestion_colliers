<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash; // Pour le hachage des mots de passe
use Illuminate\Support\Facades\Validator; // Pour la validation des données

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('Register');
    }
    public function register(Request $request)
    {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'telephone' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        // En cas d'échec de validation, retour au formulaire avec les erreurs
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Créer un nouvel utilisateur (client) avec les données validées
        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'telephone' => $request->tel,
            'password' => Hash::make($request->password),
        ]);
        dd('Client créé avec succès', $client);

        // // Appel de la méthode de connexion depuis LoginController
        $loginController = new LoginController();
        $loginController->login($client); // Passer la requête pour se connecter automatiquement

        // Redirection après l'inscription
        return redirect()->route('showDashClient')->with('success', 'Inscription réussie !');
    }
}
