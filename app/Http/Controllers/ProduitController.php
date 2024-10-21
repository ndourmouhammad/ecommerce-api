<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        return $this->customJsonResponse("Listes des produits récupérées : ", $produits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        $produit = new Produit();
        $produit->fill($request->validated());
        $produit->save();
        return $this->customJsonResponse("Produit créé", $produit);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return $this->customJsonResponse("Produit introuvable", null, 404);
        }
        return $this->customJsonResponse("Produit récupéré", $produit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, $id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return $this->customJsonResponse("Produit introuvable", null, 404);
        }
        $produit->fill($request->validated());
        $produit->update();
        return $this->customJsonResponse("Produit mis a jour", $produit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return $this->customJsonResponse("Produit introuvable", null, 404);
        }
        $produit->delete();
        return $this->customJsonResponse("Produit supprime", null, 200);
    }
}
