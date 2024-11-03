<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié et qu'il est un admin
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        else {
            dd('Not authenticated as admin'); // Temporary for debugging
        }

        // Rediriger avec un message d'erreur s'il n'est pas un administrateur
        return redirect('/login')->with('error', 'Accès réservé aux administrateurs.');
    
    }
}
