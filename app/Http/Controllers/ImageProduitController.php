<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageProduitRequest;
use App\Http\Requests\UpdateImageProduitRequest;
use App\Models\ImageProduit;

class ImageProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imageProduits = ImageProduit::all();
        return $this->customJsonResponse("Listes des images produits récupérées : ", $imageProduits);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageProduitRequest $request)
    {
        $imageProduit = new ImageProduit();
        $imageProduit->fill($request->validated());

        if ($request->hasFile('path')) {
            $path = $request->file('path');
            $imageProduit->path = $path->store('images', 'public');
        }

        $imageProduit->save();
        return $this->customJsonResponse("Image Produit créée", $imageProduit);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imageProduit = ImageProduit::find($id);
        if (!$imageProduit) {
            return $this->customJsonResponse("Image Produit introuvable", null, 404);
        }
        return $this->customJsonResponse("Image Produit récupérée", $imageProduit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageProduitRequest $request,$id)
    {
        $imageProduit = ImageProduit::find($id);
        if (!$imageProduit) {
            return $this->customJsonResponse("Image Produit introuvable", null, 404);
        }
        $imageProduit->fill($request->validated());
        if ($request->hasFile('path')) {
            $path = $request->file('path');
            $imageProduit->path = $path->store('images', 'public');
        }
        $imageProduit->update();
        return $this->customJsonResponse("Image Produit mise a jour", $imageProduit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imageProduit = ImageProduit::find($id);
        if (!$imageProduit) {
            return $this->customJsonResponse("Image Produit introuvable", null, 404);
        }   
        $imageProduit->delete();
        return $this->customJsonResponse("Image Produit supprime", null, 200);
    }
}
