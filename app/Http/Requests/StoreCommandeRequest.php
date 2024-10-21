<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
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
                'produits' => 'required|array',
                'produits.*' => 'exists:produits,id',
                'quantites' => 'required|array',
                'quantites.*' => 'integer|min:1',
                'prix_unitaire' => 'required|array',
                'prix_unitaire.*' => 'numeric|min:0',
            ];
    }
}
