<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpParser\Nde\Expr\Assign;

class AuthController extends Controller
{
    public function register(StoreAuthRequest $request)
    {
        // Validator the request
    
        $photo_profile = null;
        if ($request->hasFile('photo_profile')) {
            $photo_profile = $request->file('photo_profile')->store('profiles', 'public');
        }
        // Hash the password
        $password = Hash::make($request->password);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'adresse' => $request->adresse,
            'numero_telephone' => $request->numero_telephone,
            'photo_profil' => $photo_profile,
        ]);


        // assignn role
        $user->assignRole('Client');

        // return the user
        return $this->customJsonResponse("Utilisateur créé avec succès", $user);
   

    }
}
