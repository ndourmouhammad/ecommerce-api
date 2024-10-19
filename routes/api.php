<?php
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// Rafraîchir le token JWT
Route::post('/refresh', [AuthController::class, 'refresh']);

// Réinitialiser le mot de passe
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
Route::post('/password/reset/{token}', [ResetPasswordController::class, 'update']);

// Envoyer un lien de vérification d'email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return response()->json(['message' => 'Email de vérification envoyé.']);
})->middleware('auth:api');

// Vérifier l'email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return response()->json(['message' => 'Email vérifié avec succès.']);
})->middleware(['auth:api', 'signed']);

// Protéger les routes avec la vérification d'email
Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});