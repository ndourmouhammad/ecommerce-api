<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarqueRequest;
use App\Http\Requests\UpdateMarqueRequest;
use App\Models\Marque;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = Marque::all();
        return $this->customJsonResponse("Listes des marques récupérées : ", $marques);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarqueRequest $request)
    {
        $marque = new Marque();
        $marque->fill($request->validated());
        $marque->save();

        return $this->customJsonResponse("Marque ajoutée avec succès", $marque);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marque = Marque::findOrFail($id);
        if (!$marque) {
            return $this->customJsonResponse("Marque introuvable", null, 404);
        }

        return $this->customJsonResponse("Marque récupérée : ", $marque);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarqueRequest $request, $id)
    {
        $marque = Marque::findOrFail($id);
        if (!$marque) {
            return $this->customJsonResponse("Marque introuvable", null, 404);
        }
        $marque->fill($request->validated());
        $marque->update();

        return $this->customJsonResponse("Marque mise à jour avec succès", $marque);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $marque = Marque::findOrFail($id);
        if (!$marque) {
            return $this->customJsonResponse("Marque introuvable", null, 404);
        }
        $marque->delete();
        return $this->customJsonResponse("Marque supprimée avec succès", $marque);
    }
}
