<?php

namespace App\Http\Controllers; // Définition de l'espace de noms pour le contrôleur

use App\Http\Controllers\Controller; // Inclusion de la classe Controller de Laravel
use App\Models\Admin; // Inclusion du modèle Admin
use App\Models\Client;
use App\Models\Livreur;
use Illuminate\Http\Request; // Inclusion de la classe Request de Laravel
use Illuminate\Support\Facades\Auth; // Inclusion du façade Auth pour gérer l'authentification
use Illuminate\Support\Facades\Hash; // Inclusion du façade Hash pour le hachage de mot de passe
use Illuminate\Support\Facades\Log; // Inclusion du façade Log pour les enregistrements de logs

class LoginController extends Controller // Déclaration de la classe LoginController qui hérite de la classe Controller
{
    public function showLoginForm()
    {
        // Affiche le formulaire de connexion
        return view('Login'); // Retourne la vue 'Login'
    }
    public function login(Request $request)
    {
        // Valider les champs 'email' et 'password'
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        // Récupérer les credentials (email et password)
        $email = $request->email;
        $password = $request->password;

        // Vérifier si l'email et le mot de passe correspondent à un admin
        // $admin = Admin::where('email', $email)->first();
        // if ($admin && Hash::check($password, $admin->password)) {
        //     // Authentifier l'admin
        //     session(['admin' => true]);
        //     return redirect()->intended('/admin/dashboard');
        // }
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }
    

        // Vérifier si l'email et le mot de passe correspondent à un client
        $client = \App\Models\Client::where('email', $email)->first();
        if ($client && Hash::check($password, $client->password)) {
            // Authentifier le client
            session(['client' => true]);
            return redirect()->intended('/client/dashboard');
        }

        // Vérifier si l'email et le mot de passe correspondent à un livreur
        $livreur = \App\Models\Livreur::where('email', $email)->first();
        if ($livreur && Hash::check($password, $livreur->password)) {
            // Authentifier le livreur
            session(['livreur' => true]);
            return redirect()->intended('/livreur/dashboard');
        }

        // Si aucune authentification n'a réussi, retourner une erreur
        return back()->withErrors([
            'email' => 'Les informations d’identification ne correspondent pas ou le compte n\'existe pas.',
        ])->withInput($request->except('password')); // Conserve l'email mais pas le mot de passe
    }
}
