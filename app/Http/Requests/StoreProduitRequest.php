<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "libelle" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "prix_unitaire" => ["required", "numeric"],
            "marque_id" => ["nullable", "exists:marques,id"],
            "categorie_id" => ["nullable", "exists:produits,id"],
            "date_ajout" => ["nullable", "date"],
            "quantite_actuellement_disponible" => ["required", "numeric"],
            "en_rupture" => ["nullable", "boolean"],
            "caracteristiques" => ["required", "json"],
            "prix_en_promo" => ["nullable", "numeric"],
            "type" => ["required", "string", "max:255"],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ['success' => false, 'errors' => $validator->errors()],
            422
        ));
    }
}
