<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProduitRequest extends FormRequest
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
            "libelle" => ["sometimes", "string", "max:255"],
            "description" => ["sometimes", "string", "max:255"],
            "prix_unitaire" => ["sometimes", "numeric"],
            "marque_id" => ["nullable", "exists:marques,id"],
            "categorie_id" => ["nullable", "exists:produits,id"],
            "date_ajout" => ["nullable", "date"],
            "quantite_actuellement_disponible" => ["sometimes", "numeric"],
            "en_rupture" => ["nullable", "boolean"],
            "caracteristiques" => ["sometimes", "json"],
            "prix_en_promo" => ["nullable", "numeric"],
            "type" => ["sometimes", "string", "max:255"],
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
