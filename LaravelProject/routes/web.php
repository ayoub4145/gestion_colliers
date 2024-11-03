<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
Route::get('/', function () {
    return view('index');
})->name('homepage');
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
    Route::get('/dashboard', [AdminController::class, 'showDash'])->name('showDashAdmin');
    Route::get('/ajt_livreur',[AdminController::class,'showForm'])->name('showForm');
    Route::post('/ajt_livreur',[AdminController::class, 'ajouterLivreur'])->name('livreur');
    Route::get('/modif_livreur/{id}',[AdminController::class,'modifierLivreurForm'])->name('livreur_mod');
    Route::delete('/supp_livreur/{id}', [AdminController::class, 'deleteLivreur'])->name('livreur.delete');
    // Route::get('/supp_livreur/{id}',[AdminController::class,'supprimerLivreurForm'])->name('livreur_supp');
    Route::put('/modif_livreur/{id}',[AdminController::class,'modifierLivreur'])->name('modifLivreur');
    // Route::post('/supp_livreur',[AdminController::class,'supprimerLivreur'])->name('suppLivreur');
    // Route::post('/login', [AdminController::class, 'login']);
    // Route::post('/logout', [AdminController::class, 'logout']);
    Route::post('/search', [ColisController::class, 'getColisByNumeroSuivi'])->name('search');
    Route::get('/admin/profil', [AdminController::class, 'showProfil'])->name('admin.profil');
    Route::put('/admin/update', [AdminController::class, 'updateProfil'])->name('admin.update');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');


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

