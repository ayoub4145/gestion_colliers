<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pour l'authentification
use Illuminate\Validation\ValidationException;
use App\Models\Colis;
use App\Notifications\ColisAffecteNotification;


class LivreurController extends Controller
{
        public function showDash()
        {
            $livreur=Auth::user();
            if (!$livreur) {
                return redirect()->route('LoginForm')->with('error', 'Veuillez vous connecter.');
            }

            // Récupérer les colis affectés au livreur
            $assignedColis = Colis::where('livreur_id', $livreur->id)->get();
             // Envoyer la notification par email
            //  $livreur->notify(new ColisAffecteNotification([$assignedColis]));
            return view('livreur.dashboard',compact('livreur','assignedColis'));
        }
        public function logout(Request $request)
        {
            Auth::logout(); // Déconnecte l'utilisateur

            $request->session()->invalidate(); // Invalide la session
            $request->session()->regenerateToken(); // Régénère le token CSRF pour plus de sécurité

            return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
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
        public function signalerOccupé()
        {
            // Trouver le livreur par son ID
            $livreur = Auth::user();

            if (!$livreur) {
                return redirect()->back()->with('error', 'Livreur introuvable.');
            }

            // Mettre le statut du livreur à occupé
            $livreur->statut_livreur = false;
            // $livreur->save();

            return redirect()->back()->with('success', 'Votre statut a été mis à jour comme "Occupé".');
        }
        public function accepterLivraison(Colis $colis)
        {
            $livreur = Auth::user();

            if (!$livreur) {
                return redirect()->route('LoginForm')->with('error', 'Veuillez vous connecter.');
            }

            // Mettre à jour le statut du colis
            $colis->statut_colis = "En cours";
            $colis->save();

            // Ajouter un message flash
            session()->flash('succes', 'Le colis est maintenant en cours d\'envoi.');

            // Récupérer les colis affectés au livreur pour le tableau de bord
            $assignedColis = Colis::where('livreur_id', $livreur->id)->get();

            return view('livreur.dashboard', compact('colis', 'livreur', 'assignedColis'));

        }
        public function afficherReclamationForm(){
             // Récupérer le livreur connecté
                $livreur = Auth::user();

                // Récupérer le colis associé au livreur connecté
                $colis = Colis::where('livreur_id', $livreur->id)->first();

                // Vérifier si un colis est trouvé, sinon retourner une erreur ou un message
                if (!$colis) {
                    return back()->with('error', 'Aucun colis associé à ce livreur.');
                }

            return view('livreur.reclamationForm',compact('colis'));
        }
        public function estLivre(Request $request)
        {
            //dd($request->all());

            // Validation des données
            $validated = $request->validate([
                'colis_id' => 'required|exists:colis,id',
                'status' => 'required|in:oui,non',
                'probleme' => 'nullable|string|max:255',
            ]);
        
            // Trouver le colis
            $colis = Colis::findOrFail($validated['colis_id']);
        
            // Mettre à jour le statut du colis basé sur 'status'
            if ($validated['status'] === 'oui') {
                $colis->statut_colis = 'Livré'; // Doit correspondre exactement à une des valeurs de l'enum
            } else {
                $colis->statut_colis = 'En attente'; // Ou tout autre valeur pertinente
            }
        
            // Ajouter une réclamation si nécessaire
            $colis->reclamation = $validated['probleme'] ?? 'Aucun problème spécifié.';
        
            // Sauvegarder les modifications
            $colis->save();
        
            // Rediriger ou retourner une vue avec un message
            return redirect()->route('showDashLivreur')->with('success', 'Le statut du colis a été mis à jour avec succès.');
        }

        
            }
