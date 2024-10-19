<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAuthRequest extends FormRequest
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

     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:25',
            'email' => 'required|string|email|min:3|max:25|unique:users',
            'password' => 'required|string|min:8',
            'adresse' => 'required|string|min:2|max:55',
            'numero_telephone' => 'required|integer|min:9',
        
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'errors'      => $validator->errors()
        ], 422));
    }
}
