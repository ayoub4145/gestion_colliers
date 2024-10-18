<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class LoginController extends Controller
{


    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('Login');
    }

    // Traite la requête de connexion
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Tentative de connexion
        if (Auth::attempt($this->credentials($request), $request->filled('remember'))) {
            $request->session()->regenerate();

            return $this->authenticated($request, Auth::user())
                ?: redirect()->intended($this->redirectPath());
        }

        // Si la connexion échoue, on renvoie une erreur
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    // Valide les champs de connexion
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    // Retourne le champ utilisé pour la connexion
    public function username()
    {
        return 'email';  // Par défaut, on utilise l'email pour le login
    }

    // Crédentials pour la connexion
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    // Méthode appelée après une connexion réussie
    protected function authenticated(Request $request, $user)
    {
        // Optionnel : ajouter des actions après connexion (log, notifications, etc.)
    }

    // Redirection après connexion réussie
    protected function redirectPath()
    {
        return '/dashboard'; // Modifie cette route si nécessaire
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Utilisation du guard spécifique pour cette méthode
    protected function guard()
    {
        return Auth::guard();
    }
}
