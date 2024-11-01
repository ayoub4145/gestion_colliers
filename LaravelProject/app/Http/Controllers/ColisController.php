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
            return response()->json([
                'success' => true,
                'data' => [
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
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Colis introuvable avec ce numéro de suivi.'
            ], 404);
        }
    }

}
