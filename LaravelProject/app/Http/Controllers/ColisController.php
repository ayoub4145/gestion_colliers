<?php
namespace App\Http\Controllers;

use App\Models\Colis;
use App\Models\Client;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Notifications\EchecLivraisonNotification;
use Illuminate\Support\Facades\Notification;


class ColisController extends Controller
{
    public function getColisByNumeroSuivi(Request $request)
    {
        $query = $request->input('query');

        $colis = Colis::with(['expediteur', 'destinataire', 'livreur'])
            ->where('numero_suivi', $query)
            ->first();
            if ($colis) {
                // Prépare les données du colis dans un tableau
                $colisData = [
                    'numero_suivi' => $colis->numero_suivi,
                    'description' => $colis->description,
                    'contenu_colis' => $colis->contenu_colis,
                    'statut_colis' => $colis->statut_colis,
                    'poids' => $colis->poids,
                    'prix' => $colis->prix,
                    'expediteur_nom' => $colis->expediteur->nom ?? 'Non spécifié',
                    'expediteur_prenom' => $colis->expediteur->prenom ?? '',
                    'destinataire_nom' => $colis->destinataire->nom ?? 'Non spécifié',
                    'destinataire_prenom' => $colis->destinataire->prenom ?? '',
                    'livreur_nom' => $colis->livreur->nom ?? 'Non attribué',
                    'livreur_prenom' => $colis->livreur->prenom ?? '',
                    'date_livraison' => $colis->date_livraison,
                ];

                // Renvoyer les données à la vue
                return view('colis_info', compact('colisData'));
            } else {
                return view('colis_info')->with('error', 'Colis introuvable avec ce numéro de suivi.');
            }


        }
        public function confirmerEnvoiColis(Request $request, $colis_id)
        {
            $colis = Colis::find($colis_id);

            if (!$colis) {
                return response()->json(['message' => 'Colis non trouvé.'], 404);
            }

            $confirmation = $request->input('confirmation');
            $raison = $request->input('raison');

            if ($confirmation) {
                // Marquer le colis comme livré
                $colis->statut_colis = 'Livré';
                $colis->save();

                return response()->json(['message' => 'Le colis a été confirmé comme envoyé.']);
            } else {
                // Marquer le colis comme non livré avec une raison
                if (!$raison) {
                    return response()->json(['message' => 'La raison de l’échec de livraison doit être fournie.'], 400);
                }

                $colis->statut_colis = 'Non livré';
                $colis->raison_non_livraison = $raison;
                $colis->save();

                // Notifier l'admin et le client
                $this->notifierEchecLivraison($colis, $raison);

                return response()->json(['message' => 'Le colis n’a pas pu être livré. La raison a été communiquée.']);
            }
        }

        protected function notifierEchecLivraison($colis, $raison)
        {
            // Notifier tous les admins
            Notification::send(Admin::all(), new EchecLivraisonNotification($colis, $raison));

            // Notifier le client du colis
            $client = $colis->client;
            Notification::send($client, new EchecLivraisonNotification($colis, $raison));
        }

}
