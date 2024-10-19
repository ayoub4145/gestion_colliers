<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Login');
    }

    public function login(Request $request)
    {
        // Valider les champs 'email' et 'password'
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        // Récupérer les credentials (email et password)
        $credentials = $request->only('email', 'password');

        // Tenter d'authentifier comme admin
        if ($admin = Admin::where('email', $request->email)->first()) {
            // Vérifier le mot de passe
            if (Hash::check($request->password, $admin->password)) {
                // Authentifier l'admin
                session(['admin' => true]);
                Log::info('Tentative de connexion pour l\'admin avec l\'email: ' . $request->email);
                return redirect()->intended('/admin/dashboard');
            }
        }

        // Tenter d'authentifier comme client
        if (Auth::guard('client')->attempt($credentials)) {
            return redirect()->intended('/client/dashboard');
        }

        // Tenter d'authentifier comme livreur
        if (Auth::guard('livreur')->attempt($credentials)) {
            return redirect()->intended('/livreur/dashboard');
        }

        // Si l'authentification échoue, retourner une erreur
        return back()->withErrors([
            'email' => 'Les informations d’identification ne correspondent pas ou le compte n\'existe pas.',
        ])->withInput($request->except('password')); // Conserve l'email mais pas le mot de passe
    }
}
