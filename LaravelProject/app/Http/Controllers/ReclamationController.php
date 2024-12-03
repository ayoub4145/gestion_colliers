<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colis;

class ReclamationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'colis_id' => 'required|exists:colis,id',
            'status' => 'required|in:oui,non',
            'probleme' => 'nullable|string|max:255',
        ]);
    
        // Trouver le colis
        $colis = Colis::findOrFail($validated['colis_id']);
    
        // Trouver le livreur associé au colis
        $livreur = $colis->livreur;
    
        if ($livreur) {
            // Mettre à jour la réclamation du livreur
            $livreur->reclamation = $validated['probleme'] ?? 'Aucun problème spécifié.';
            $livreur->save();
        }
    
        // Retourner au tableau de bord avec un message
        return redirect()->route('showDashClient')->with('succes', 'Réclamation envoyée avec succès.');
    }
    

}
