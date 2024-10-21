<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
    


// User Registration and Authentication Routes
Route::post('/register', [AuthController::class, 'register']);  // Register a new user
Route::post('/login', [AuthController::class, 'login']);        // Login user and return JWT token
Route::post('/logout', [AuthController::class, 'logout']);      // Logout the user (invalidate JWT token)
Route::post('/refresh', [AuthController::class, 'refresh']);    // Refresh JWT token



// Password Reset Routes
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);  // Request password reset link
Route::post('/reset-password', [AuthController::class, 'resetPassword']);    // Reset the password
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return response()->json(['message' => 'Email vérifié avec succès.']);
})->middleware(['signed', 'throttle:6,1'])->name('verification.verify');





// command
Route::middleware('auth:api')->group(function () {

    // 
    Route::patch('/commandes/status/{id}', [CommandeController::class, 'updateEtatCommande']);


    Route::apiResource('/commandes', CommandeController::class);
});