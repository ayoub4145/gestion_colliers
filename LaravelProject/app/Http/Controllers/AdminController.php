<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pour l'authentification
use Illuminate\Validation\ValidationException;


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
        public function ajouterLivreur(Request $request)
        {
            // Vérification des données envoyées dans la requête
            //dd($request->all());

            // Ajout d'une étape de débogage après la validation
            try {
                $validatedData = $request->validate([
                    'nom' => 'required|string|max:255',
                    'prenom' => 'required|string|max:255',
                    'adresse' => 'required|string',
                    'statut' => 'required|in:1,0',
                    'cin'=>'required|string|max:10',
                    'email' => 'required|email|unique:livreurs,email',
                    'telephone' => 'required|string|max:10',
                ]);
            } catch (ValidationException $e) {
                // Utilisation de dd() pour voir les erreurs de validation
                dd($e->errors());
            }

            // Vérifier les données validées
            // dd($validatedData);

            // Continuer avec les étapes suivantes si la validation réussit
            $password = Hash::make($request->prenom . '@' . $request->nom . '123');
            // dd($password);

            $adminId = Auth::check() ? Auth::id() : 1;
            // dd($adminId);

            // Utiliser la méthode create pour insérer les données
            $livreur = Livreur::create([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'adresse' => $validatedData['adresse'],
                'statut_livreur' => $validatedData['statut']=='1', // Convertit en booléen
                'cin' => $validatedData['cin'],
                'email' => $validatedData['email'],
                'telephone' => $validatedData['telephone'],
                'password' => $password,
                'admin_id' => $adminId,
            ]);

            // Vérification après l'insertion
            // dd($livreur);

            return redirect()->route('showDashAdmin')->with('success', 'Livreur ajouté avec succès.');
        }

}
