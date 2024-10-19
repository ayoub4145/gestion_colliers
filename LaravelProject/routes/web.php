<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('index');
});
// Afficher le formulaire de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('LoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/s_inscrire',[RegisterController::class,'showRegisterForm'])->name('RegisterForm');
Route::post('/s_inscrire',[RegisterController::class,'register'])->name('register');

// Route::post('login', [LoginController::class, 'login'])->name('login');
// Route::get('/clientDashboard',[LoginController::class,'showDashClient'])->name('dashClient');

// Authentification pour les clients
Route::prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'showDash']);
    // Route::post('/login', [ClientController::class, 'login']);
    // Route::post('/logout', [ClientController::class, 'logout']);
});

// Authentification pour les livreurs
Route::prefix('livreur')->group(function () {
    Route::get('/dashboard', [LivreurController::class, 'showDash']);
    // Route::post('/login', [LivreurController::class, 'login']);
    // Route::post('/logout', [LivreurController::class, 'logout']);
});

// Authentification pour les admins
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'showDash']);
    // Route::post('/login', [AdminController::class, 'login']);
    // Route::post('/logout', [AdminController::class, 'logout']);
});

// Traiter la requête de login (POST)
// Route::post('/login', [LoginController::class, 'login']);

// Déconnexion
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Page après connexion réussie
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth')->name('dashboard');
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

