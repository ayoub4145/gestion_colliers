<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colis;

class ReclamationController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'colis_id' => 'required|exists:colis,id',
            'status' => 'required|in:oui,non',
            'probleme' => 'nullable|string|max:255',
        ]);

        // Trouver le colis
        $colis = Colis::findOrFail($validated['colis_id']);

        // Trouver le livreur associé au colis
        $livreur = $colis->livreur;

        // Préparer un message de confirmation
        $message = 'Aucune action effectuée.';
        if ($livreur) {
            // Mettre à jour la réclamation du livreur
            $livreur->reclamation = $validated['probleme'] ?? 'Aucun problème spécifié.';
            $livreur->save();
            $message = 'Réclamation envoyée avec succès.';
        }

        // Envoyer la réponse à une vue avec les données nécessaires
        return view('client.dashboard', [
            'message' => $message,
            'colis' => $colis,
            'livreur' => $livreur,
        ]);
        // return redirect()->route('showDashLivreur');
    }



}
