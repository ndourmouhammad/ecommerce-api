<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGarantieRequest;
use App\Http\Requests\UpdateGarantieRequest;
use App\Models\Garantie;

class GarantieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garanties = Garantie::all();
        return $this->customJsonResponse("Listes des garanties récupérées : ", $garanties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGarantieRequest $request)
    {
        $garantie = new Garantie();
        $garantie->fill($request->validated());
        $garantie->save();
        return $this->customJsonResponse("Garantie créée", $garantie);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $garantie = Garantie::findOrFail($id);
        if (!$garantie) {
            return $this->customJsonResponse("Garantie introuvable", null, 404);
        }
        return $this->customJsonResponse("Garantie récupérée", $garantie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGarantieRequest $request, $id)
    {
        $garantie = Garantie::findOrFail($id);
        if (!$garantie) {
            return $this->customJsonResponse("Garantie introuvable", null, 404);
        }
        $garantie->fill($request->validated());
        $garantie->update();
        return $this->customJsonResponse("Garantie mise à jour", $garantie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Garantie $garantie)
    {
        //
    }
}
