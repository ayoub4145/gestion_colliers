<?php

namespace App\Http\Controllers;

use App\Models\Coli;
use App\Models\Colis;
use Illuminate\Support\Str;
use App\Models\Client;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }
        // Affiche le formulaire de connexion
        public function showDash(Request $request)
        {
            $client = Auth::user(); // Récupère le client connecté

            return view('client.dashboard',compact('client'));
        }
        public function updateProfil(Request $request){
            $client = Client::findOrFail(1);

            $validatedData = $request->validate([
                'email' => 'required|email|max:50|unique:clients,email,1',
                'password' => 'nullable|string|min:8|max:255',
            ]);

            // Mettre à jour l'email et le mot de passe (en hachant le mot de passe)
            $client->email = $validatedData['email'];
            $client->password = bcrypt($validatedData['password']);
            $client->save();

            return redirect()->route('showDashClient')->with('success', 'Client modifié avec succès.');
        }

        public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l'utilisateur

        $request->session()->invalidate(); // Invalide la session
        $request->session()->regenerateToken(); // Régénère le token CSRF pour plus de sécurité

        return redirect('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }


        public function showProfil() {
            $client = Auth::user(); // On récupère l'admin avec l'ID 1

            // On retourne la vue avec les données de l'admin
            return view('client.profil', compact('client'));
        }
        public function ajouter_colis(Request $request) {
            try {
                $validatedData = $request->validate([
                    'description' => 'required|string|max:500',
                    'contenu_colis' => 'required|string|max:500',
                    'poids' => 'required|numeric',
                    // 'prix' => 'required|numeric',
                    'cin'=>'required|string|max:10',
                    'ville'=>'required|string',
                    'nom_destinataire' => 'required|string|max:50',
                    'prenom_destinataire' => 'required|string|max:50',
                    'adresse_destinataire' => 'required|string|max:255',
                    'telephone_destinataire' => 'required|string|max:20',
                ]);
            } catch (ValidationException $e) {
                // Afficher les erreurs de validation
                dd($e->errors());
            }

            // Générer un numéro de suivi unique
            $numeroSuivi = strtoupper(Str::random(10));

            // Vérifier si l'admin est connecté
            // $adminId = Auth::check() ? Auth::id() : null;

            // Insérer les informations du destinataire dans la table `clients`
            $destinataire = Client::create([
                'nom' => $validatedData['nom_destinataire'],
                'prenom' => $validatedData['prenom_destinataire'], // Remplir si nécessaire
                'adresse' => $validatedData['adresse_destinataire'],
                'ville' => $request->input('ville', null), // Optionnel
                'cin' => $validatedData['cin'], // CIN temporaire si non fourni
                'email' => $request->input('email', null), // Optionnel
                'telephone' => $validatedData['telephone_destinataire'],
                'password' => Hash::make(Str::random(8)), // Mot de passe temporaire
            ]);

            // Insérer les informations du colis dans la table `colis`
            $colis = Colis::create([
                'numero_suivi' => $numeroSuivi,
                'description' => $validatedData['description'],
                'contenu_colis' => $validatedData['contenu_colis'],
                'poids' => $validatedData['poids'],
                'cin' => $validatedData['cin'],
                'expediteur_id' => Auth::id(), // ID de l'expéditeur connecté
                'destinataire_id' => $destinataire->id,
                'statut_colis' => 'En attente',
            ]);

            // Retourner une réponse ou rediriger
            // return response()->json([
            //     'message' => 'Colis ajouté avec succès.',
            //     'colis' => $colis,
            // ]);
            return redirect()->route('showDashClient')->with('success', 'Colis ajouté avec succès.');

        }
        public function showFormAjtColis(){
            return view('client.ajouter_colis');
        }
        public function getColisByNumeroSuivi(Request $request)
        {
            $client = Auth::user(); // Récupération de l'utilisateur connecté
            $query = $request->input('query');

            $colis = Colis::with(['expediteur', 'destinataire'])->where('numero_suivi', $query)->first();

            if ($colis) {
                $colisData = [
                    'numero_suivi' => $colis->numero_suivi,
                    'description' => $colis->description,
                    'contenu_colis' => $colis->contenu_colis,
                    'statut_colis' => $colis->statut_colis,
                    'poids' => $colis->poids,
                    'expediteur_nom' => $colis->expediteur->nom ?? 'Non spécifié',
                    'expediteur_prenom' => $colis->expediteur->prenom ?? '',
                    'destinataire_nom' => $colis->destinataire->nom ?? 'Non spécifié',
                    'destinataire_prenom' => $colis->destinataire->prenom ?? '',
                    'date_livraison' => $colis->date_livraison,
                    'date_reception'=>$colis->date_reception ?? 'Non spécifié',
                ];

                // Retourne la vue avec le client et les données du colis
                return view('client.dashboard', compact('client', 'colisData'));
            } else {
                // Si aucun colis n'est trouvé, retourne la vue avec un message d'erreur
                return redirect()->back()->with('error', 'Colis introuvable avec ce numéro de suivi.');
            }
        }
        
}
