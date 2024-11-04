<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Colis;
use App\Models\Livreur;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Pour l'authentification
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

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
            $password = Hash::make($request->prenom . '@' . $request->cin);
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
        public function modifierLivreur(Request $request,$id){
            $validatedData = $request->validate([
                'nom' => 'required|string|max:50',
                'prenom' => 'required|string|max:50',
                'adresse' => 'nullable|string',
                'statut' => 'required|in:1,0',
                'email' => 'required|email|unique:livreurs,email,' . $id,
                'telephone' => 'required|string|max:10',
            ]);

            // Récupérer et mettre à jour le livreur
            $livreur = Livreur::findOrFail($id);
            $livreur->update($validatedData);
            $livreur->save();

            return redirect()->route('showDashAdmin')->with('success', 'Livreur modifié avec succès.');
        }

        public function deleteLivreur($id) {
            $livreur = Livreur::find($id);

            if (!$livreur) {
                return redirect()->route('showDashAdmin')->withErrors('Livreur introuvable.');
            }

            $livreur->delete();

            return redirect()->route('showDashAdmin')->with('success', 'Livreur supprimé avec succès.');
        }

        public function modifierLivreurForm( $id){
            $livreur = Livreur::findOrFail($id);
            return view('admin.modifier_livreur_form',compact('livreur'));
        }

        // public function supprimerLivreurForm($id){
        //     $livreur = Livreur::findOrFail($id);

        //     return view('admin.supprimer_livreur_form',$livreur);
        // }
        public function showProfil() {
            $admin = Admin::findOrFail(1); // On récupère l'admin avec l'ID 1

            // On retourne la vue avec les données de l'admin
            return view('admin.profil', compact('admin'));
        }
        public function updateProfil(Request $request){
            $admin = Admin::findOrFail(1);

            $validatedData = $request->validate([
                'email' => 'required|email|max:50|unique:admins,email,1',
                'password' => 'required|string|max:255',
            ]);

            // Mettre à jour l'email et le mot de passe (en hachant le mot de passe)
            $admin->email = $validatedData['email'];
            $admin->password = bcrypt($validatedData['password']);
            $admin->save();

            return redirect()->route('showDashAdmin')->with('success', 'Admin modifié avec succès.');
        }

        public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur

        $request->session()->invalidate(); // Invalide la session
        $request->session()->regenerateToken(); // Régénère le token CSRF pour plus de sécurité

        return redirect('/login')->with('success', 'Vous avez été déconnecté avec succès.');
    }


    public function affecter_colis_au_livreur(){
        $colis_disponible=Colis::findOrFail()->where('statut_colis','En attente');
    }
}
