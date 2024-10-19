<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function showLoginForm(){
        return view('Login');
    }
    public function login(Request $request)
    {
        $userType = $request->input('user_type');  // Récupérer le type d'utilisateur

        switch ($userType) {
            case 'client':
                // Authentification pour client
                return $this->clientLogin($request);
            case 'admin':
                // Authentification pour admin
                return $this->adminLogin($request);
            case 'livreur':
                // Authentification pour livreur
                return $this->livreurLogin($request);
            default:
                return redirect()->back()->withErrors(['error' => 'Type d’utilisateur non reconnu']);
        }
    }

    // Méthodes pour chaque type d'authentification
    protected function clientLogin(Request $request)
{
    // Valider les champs email et password
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:4',
    ]);

    // Récupérer les credentials (email et password)
    $credentials = $request->only('email', 'password');

    // Tenter l'authentification en utilisant le guard client
    if (Auth::guard('client')->attempt($credentials)) {
        // Redirection vers le tableau de bord après une authentification réussie
        return redirect()->intended('/client/dashboard');
    }

    // Si l'authentification échoue, retourner une erreur
    return back()->withErrors([
        'email' => 'Les informations d’identification ne correspondent pas ou le compte n\'existe pas.',
    ])->withInput($request->except('password')); // Conserve l'email mais pas le mot de passe
}

    protected function adminLogin($request)
    {
        $admin = config('admin');

        if ($request->email === $admin['email'] && Hash::check($request->password, $admin['password'])) {
            // Stocke l'authentification dans la session
            session(['admin' => true]);
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);    }

    protected function livreurLogin($request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('livreur')->attempt($credentials)) {
            return redirect()->intended('/livreur/dashboard');
        }

        return back()->withErrors([
            'email' => 'Les informations d’identification ne correspondent pas.',
        ]);
        }
}
