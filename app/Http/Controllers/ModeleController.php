<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModeleRequest;
use App\Http\Requests\UpdateModeleRequest;
use App\Models\Modele;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modeles = Modele::all();
        return $this->customJsonResponse("Listes des modèles récupérées : ", $modeles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModeleRequest $request)
    {
        $modele = new Modele();
        $modele->fill($request->validated());
        $modele->save();

        return $this->customJsonResponse("Modèle ajoutée avec succès", $modele);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modele = Modele::findOrFail($id);
        if (!$modele) {
            return $this->customJsonResponse("Modèle introuvable", null, 404);
        }

        return $this->customJsonResponse("Modèle récupéré : ", $modele);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModeleRequest $request, $id)
    {
        $modele = Modele::findOrFail($id);
        if (!$modele) {
            return $this->customJsonResponse("Modèle introuvable", null, 404);
        }
        $modele->fill($request->validated());
        $modele->update();
        return $this->customJsonResponse("Modèle modifiée avec succès", $modele);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modele = Modele::findOrFail($id);
        if (!$modele) {
            return $this->customJsonResponse("Modèle introuvable", null, 404);
        }
        $modele->delete();
        return $this->customJsonResponse("Modèle supprimée avec succès", $modele);
    }
}
