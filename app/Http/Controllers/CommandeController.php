<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Commande;
use App\Models\CommandeProduit;
use DB;
use Illuminate\Http\Request;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les commandes avec leurs utilisateurs et produits associés
        $commandes = Commande::with(['user', 'commandes.produit'])->get();
        return $this->customJsonResponse('Liste des commandes', $commandes);

    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeRequest $request)
    {
        // Authentification de l'utilisateur
        $user = auth()->user();
    
        // Génération de la référence de commande
        $reference_commande = 'COM-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    
        try {
            // Démarrer une transaction
            DB::beginTransaction();
    
            // Créer la commande avec fillable fields
            $commande = Commande::create([
                'date_commande' => now(),
                'reference_commande' => $reference_commande,
                'etat_commande' => 'en_attente',
                'user_id' => $user->id
            ]);
    
            // Insérer les produits associés dans la table commande_produit
            foreach ($request->produits as $index => $produit_id) {
                CommandeProduit::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit_id,
                    'quantite_totale' => $request->quantites[$index],
                    'prix_total' => $request->quantites[$index] * $request->prix_unitaire[$index],
                ]);
            }
    
            // Charger les produits liés à la commande
            $commande->load('commandes');
    
            // Confirmer la transaction
            DB::commit();
    
            // Retourner une réponse JSON personnalisée avec les produits
            return $this->customJsonResponse('Commande créée avec succès', $commande);
    
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollBack();
    
            // Retourner une réponse d'erreur JSON
            return response()->json([
                'error' => 'Erreur lors de la création de la commande.',
                'details' => $e->getMessage()  // À enlever en production pour éviter d'exposer les détails
            ], 500);
        }
    }

    
    /**
     * Display update etat_commande 
     */
    public function updateEtatCommande( $id, Request $request) {
        // Valider l'état de la commande
        $request->validate([
            'etat_commande' => 'required|string|max:255', // Adapter selon vos besoins
        ]);
    
        // commande
        $commande = Commande::find($id);
        if (!$commande) {
            return response()->json([
                'error' => 'Commande introuvable.',
            ], 404);
        }
        // Mettre à jour l'état de la commande
        $commande->etat_commande = $request->etat_commande;
        $commande->save();
    
        return $this->customJsonResponse('État de la commande modifié avec succès', $commande);
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
