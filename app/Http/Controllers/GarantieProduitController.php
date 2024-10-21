<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGarantieProduitRequest;
use App\Http\Requests\UpdateGarantieProduitRequest;
use App\Models\GarantieProduit;

class GarantieProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garantieProduits = GarantieProduit::all();
        return $this->customJsonResponse("Listes des garanties produits récupérées : ", $garantieProduits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGarantieProduitRequest $request)
    {
        $garantieProduit = new GarantieProduit();
        $garantieProduit->fill($request->validated());
        $garantieProduit->save();
        return $this->customJsonResponse("Garantie Produit créée", $garantieProduit);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $garantieProduit = GarantieProduit::find($id);
        if (!$garantieProduit) {
            return $this->customJsonResponse("Garantie Produit introuvable", null, 404);
        }
        return $this->customJsonResponse("Garantie Produit récupérée", $garantieProduit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGarantieProduitRequest $request, $id)
    {
        $garantieProduit = GarantieProduit::find($id);
        if (!$garantieProduit) {
            return $this->customJsonResponse("Garantie Produit introuvable", null, 404);
        }
        $garantieProduit->fill($request->validated());
        $garantieProduit->update();
        return $this->customJsonResponse("Garantie Produit mise a jour", $garantieProduit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $garantieProduit = GarantieProduit::find($id);
        if (!$garantieProduit) {
            return $this->customJsonResponse("Garantie Produit introuvable", null, 404);
        }
        $garantieProduit->delete();
        return $this->customJsonResponse("Garantie Produit supprimée", null, 200);
    }
}
