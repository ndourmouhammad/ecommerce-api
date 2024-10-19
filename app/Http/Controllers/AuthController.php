<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use RateLimiter;

class AuthController extends Controller
{
    public function register(StoreAuthRequest $request)
    {
        // Gérer le téléversement de la photo de profil, si elle existe
        $photo_profile = null;
        if ($request->hasFile('photo_profile')) {
            $photo_profile = $request->file('photo_profile')->store('profiles', 'public');
        }

        // Hash du mot de passe
        $password = Hash::make($request->password);

        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'adresse' => $request->adresse,
            'numero_telephone' => $request->numero_telephone,
            'photo_profil' => $photo_profile,
        ]);

        // Assignation du rôle
        $user->assignRole('Client');

        // Envoyer l'e-mail de vérification
        event(new Registered($user));

        // Répondre avec succès
        return $this->customJsonResponse("Utilisateur créé avec succès. Veuillez vérifier votre adresse e-mail.", $user);
    }


    public function login(Request $request)
    {
        // Validation des données de la requête
        $validator = validator($request->all(), [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        // Créer une clé unique pour le throttling basé sur l'email de l'utilisateur et l'adresse IP
        $throttleKey = $request->input('email').'|'.$request->ip();

        // Vérifier si trop de tentatives ont été effectuées
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return response()->json([
                'message' => "Trop de tentatives de connexion. Réessayez dans $seconds secondes.",
            ], 429); // Code de statut HTTP 429 pour "Trop de requêtes"
        }

        // Vérifier si l'utilisateur existe
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            RateLimiter::hit($throttleKey, 10); // Incrémenter le compteur de tentatives
            return response()->json([
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }

        // Vérifier si le mot de passe est correct
        if (!Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60); // Incrémenter le compteur en cas de mot de passe incorrect
            return response()->json([
                'message' => 'Mot de passe incorrect',
            ], 401);
        }

        // Authentification réussie, réinitialiser les tentatives
        RateLimiter::clear($throttleKey); // Réinitialiser le compteur de tentatives réussie

        // Générer le token JWT
        $token = auth()->guard('api')->login( $user);

        return response()->json(data: [
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60, // Expiration en secondes
        ]);
    }

    public function refresh()
{
    $token = auth()->guard('api')->refresh();
    return response()->json(data: [
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->guard('api')->factory()->getTTL() * 60, // Expiration en secondes
    ]);
   
    
}

    // logout
    public function logout()
    {
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Déconnexion réussie.']);
    }
}
