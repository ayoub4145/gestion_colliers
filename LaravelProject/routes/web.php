<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('index');
});
// Afficher le formulaire de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('LoginForm');

// Traiter la requête de login (POST)
// Route::post('/login', [LoginController::class, 'login']);

// Déconnexion
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Page après connexion réussie
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');