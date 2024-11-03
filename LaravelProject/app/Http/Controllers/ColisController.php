<?php
namespace App\Http\Controllers;

use App\Models\Colis;
use App\Models\Client;
use App\Models\Livreur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

}
