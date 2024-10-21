<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return $this->customJsonResponse("Listes des catégories récupérées : ", $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $categorie = new Categorie();
        $categorie->fill($request->validated());
        $categorie->save();
        return $this->customJsonResponse("Catégorie créée", $categorie);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return $this->customJsonResponse("Catégorie introuvable", null, 404);
        }
        return $this->customJsonResponse("Catégorie récupérée", $categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, $id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return $this->customJsonResponse("Catégorie introuvable", null, 404);
        }
        $categorie->fill($request->validated());
        $categorie->update();
        return $this->customJsonResponse("Catégorie mise à jour", $categorie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return $this->customJsonResponse("Catégorie introuvable", null, 404);
        }
        $categorie->delete();
        return $this->customJsonResponse("Catégorie supprimée", null, 200);
    }
}
