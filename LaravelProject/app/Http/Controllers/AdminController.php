<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
        // Affiche le formulaire de connexion
        public function showDash()
        {
            // $liste_livreurs=Livreur::where('statut_livreur','Disponible')->paginate(10);
            $liste_livreurs=Livreur::paginate(10);
            $liste_colis=Colis::paginate(10);
            // dd($liste_colis);
            // dd($liste_livreurs); // Cela va afficher les données retournées et arrêter l'exécution
            return view('admin.dashboard',compact('liste_livreurs','liste_colis'));
        }
        public function showForm(){
            return view('admin.ajouter_livreur_form');
        }
        public function ajouterLivreur(Request $request){
           $validatedData= $request->validate([
             'nom' => 'required|string|max:255',
             'prenom' => 'required|string|max:255',
             'adresse' => 'required|string',
             'statut' => 'required|in:Disponible,Occupé',
             'email' => 'required|email|unique:livreurs',
             'telephone' => 'required|string|max:10',
            ]);
             // Générer le mot de passe dynamique : Prenom@Nom123
        $password = $request->prenom . '@' . $request->nom . '123';

        // Créer un nouvel objet livreur
        $livreur = new Livreur();
        $livreur->nom = $validatedData['nom'];
        $livreur->prenom = $validatedData['prenom'];
        $livreur->adresse = $validatedData['adresse'];
        $livreur->statut_livreur = $validatedData['statut'];
        $livreur->email = $validatedData['email'];
        $livreur->telephone = $validatedData['telephone'];

        // Hacher le mot de passe avant de l'enregistrer dans la base de données
        $livreur->password = Hash::make($password);

        // Assigner l'admin_id avec l'utilisateur connecté (si applicable)
        $livreur->admin_id=1;
        //  = auth()->id(); // Si tu veux lier au user connecté, sinon assigner manuellement

        try {
            $livreur->save();
            return redirect()->route('showDashAdmin')->with('success', 'Livreur ajouté avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
        }
        }


}
