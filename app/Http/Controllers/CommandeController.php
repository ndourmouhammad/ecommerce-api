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
        // Récupérer la commande avec ses utilisateurs et produits associés
        $commande = Commande::with(['user', 'commandes.produit'])->find($commande);
        if (!$commande) {
            return response()->json([
                'error' => 'Commande introuvable.',
            ], 404);
        }
        // Retourner une réponse JSON personnalisée avec les produits
        return $this->customJsonResponse('Commande', $commande);
        
    }

  
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        // auth user
        $user = auth()->user();
        if ($user->id!= $commande->user_id) {
            return response()->json([
                'error' => 'Vous n\'êtes pas le propriétaire de cette commande.',
            ], 403);
        }

        // Valider les données










        $request->validate([
            'reference_commande' => 'required|string|max:255',
            'etat_commande' => 'required|string|max:255', // Adapter selon vos besoins
        ]);
        // Mettre à jour la commande
        $commande->update($request->all());
        // Retourner une réponse JSON personnalisée avec les produits
        return $this->customJsonResponse('Commande modifiée avec succès', $commande);


        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        // auth user
        if (!auth()->user()->hasRole(['Client','Admin'])) {
            return response()->json([
               'success' => false,
               'message' => 'Vous n\'êtes pas autorisé à effectuer cette action.',
            ], 403);
        }
        // Vérifier si la commande est liée à des commandes produits
        $commande_produits = CommandeProduit::where('commande_id', $commande->id)->get();
        if ($commande_produits->count() > 0) {
            return response()->json([
                'error' => 'Impossible de supprimer une commande avec des produits associés.',
            ], 400);
        }
        // Supprimer la commande
        $commande->delete();

        // Retourner une réponse JSON personnalisée
        return $this->customJsonResponse('Commande supprimée avec succès', null);
       
    }
    

    // Mes commande client connecte
    public function myCommandes(){
        // Auth user
        $user = auth()->user();
        // Récupérer toutes les commandes avec leurs utilisateurs et produits associés
        $commandes = Commande::where('user_id', $user->id)->with(['user', 'commandes.produit'])->get();
        return $this->customJsonResponse('Liste des commandes', $commandes);
    }
}
