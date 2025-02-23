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
use App\Notifications\EchecLivraisonNotification;
use Illuminate\Notifications\Notification;


class AdminController extends Controller
{    public function colisLivreur($livreurId)
    {
        // Récupérer le livreur par ID
        $livreur = Livreur::find($livreurId);

        if (!$livreur) {
            // return redirect()->route('livreur.liste')->with('error', 'Livreur introuvable.');
        }

        // Récupérer tous les colis affectés à ce livreur
        $colisAffectes = Colis::where('livreur_id', $livreurId)->get()?? collect();

        // Retourner la vue avec les colis affectés et les informations du livreur
        return view('livreur.dashboard', compact('livreur', 'colisAffectes'));
    }


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
                'password' => 'nullable|string|min:8|max:255',
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

        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }

//     public function affecterColisAuLivreur($livreurId)
//     {
//         // Récupérer le livreur
//         $livreur = Livreur::find($livreurId);
//         if (!$livreur) {
//             return redirect()->back()->with('error', 'Livreur introuvable.');
//         }

//         // Vérifier s'il existe des colis non affectés
//         $colis = Colis::whereNull('livreur_id')->first(); // Le premier colis sans livreur assigné
//         if (!$colis) {
//             return redirect()->back()->with('error', 'Aucun colis disponible à affecter.');
//         }

//         // Affecter le colis au livreur
//         $colis->livreur_id = $livreur->id;
//         $colis->statut_colis = 'En attente'; // Le colis passe en statut "en attente"
//         if (!$colis->save()) {
//             dd('Erreur lors de la sauvegarde du colis');
//         }
//         $colis->save();

//         // Mettre à jour la disponibilité du livreur
//         // $livreur->statut_livreur = false; // Le livreur est désormais occupé
//         if (!$livreur->save()) {
//             dd('Erreur lors de la mise à jour du livreur');
//         }
//         // $livreur->save();
//  // Récupérer les colis affectés au livreur
//  $assignedColis = Colis::where('livreur_id', $livreur->id)->get();
//  // Rediriger vers la vue du tableau de bord avec les données
//  return view('livreur.dashboard', compact('livreur', 'assignedColis'))
//      ->with('success', 'Colis affecté avec succès.');
//     }


// Méthode pour marquer un colis comme livré et mettre à jour le statut du livreur si nécessaire
// public function terminer_livraison($livreur_id)
// {
//     // Récupérer tous les colis en cours de livraison pour le livreur
//     $colis_en_cours = Colis::where('livreur_id', $livreur_id)
//                            ->where('statut_colis', 'En cours')
//                            ->get();

//     foreach ($colis_en_cours as $colis) {
//         // Marquer le colis comme "Livré"
//         $colis->statut_colis = 'Livré';
//         $colis->save();
//     }

//     // Vérifier si tous les colis du livreur sont livrés
//     $colis_restants = Colis::where('livreur_id', $livreur_id)
//                            ->where('statut_colis', 'En cours de livraison')
//                            ->exists();

//     // Si le livreur n'a plus de colis en cours de livraison, le remettre en statut "Disponible"
//     if (!$colis_restants) {
//         $livreur = Livreur::find($livreur_id);
//         $livreur->statut = 'Disponible';
//         $livreur->save();
//     }

//     return "Le livreur a terminé ses livraisons et est maintenant disponible.";
// }
// public function confirmer_envoi_colis($colis_id, $confirmation, $raison = null)
// {
//     // Récupérer le colis
//     $colis = Colis::find($colis_id);

//     if (!$colis) {
//         return "Colis non trouvé.";
//     }

//     if ($confirmation) {
//         // Si le livreur confirme l'envoi
//         $colis->statut_colis = 'Livré';
//         $colis->save();

//         return "Le colis a été confirmé comme envoyé.";
//     } else {
//         // Si le livreur ne peut pas livrer le colis, enregistrer la raison
//         if (!$raison) {
//             return "La raison de l'échec de livraison doit être fournie.";
//         }

//         $colis->statut_colis = 'Non livré';
//         $colis->raison_non_livraison = $raison;
//         $colis->save();

//         // Notifier l'admin et le client avec la raison
//         $this->notifier_echec_livraison($colis, $raison);

//         return "Le colis n'a pas pu être livré. La raison a été communiquée à l'admin et au client.";
//     }
// }

// // Méthode pour notifier l'admin et le client en cas d'échec de livraison
// protected function notifier_echec_livraison($colis, $raison)
// {
//     // Envoi d'une notification à l'admin
//     Notification::send(Admin::all(), new EchecLivraisonNotification($colis, $raison));

//     // Envoi d'une notification au client
//     $client = $colis->client; // Assurez-vous que la relation entre Colis et Client est bien définie
//     Notification::send($client, new EchecLivraisonNotification($colis, $raison));
// }
// public function affecterLiveur($livreur_id){
//      // Trouver le livreur par son ID
//      $livreur = Livreur::find($livreurId);

//      if (!$livreur) {
//          return redirect()->back()->with('error', 'Livreur introuvable.');
//      }

//      // Vérifier si le livreur est disponible
//      if (!$livreur->statut_livreur) {
//          return redirect()->back()->with('error', 'Ce livreur est déjà occupé.');
//      }
// }
}
