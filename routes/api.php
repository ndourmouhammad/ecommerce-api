<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\GarantieController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ImageProduitController;
use App\Http\Controllers\GarantieProduitController;
    


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
    Route::get('/commandes/client', [CommandeController::class, 'myCommandes']);
    Route::get('/commandes/status/{etat_commande}', [CommandeController::class, 'indexByEtat']);
    Route::apiResource('/commandes', CommandeController::class);
});


// Marque CRUD
Route::apiResource('/marques', MarqueController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/marques/{id}', [MarqueController::class, 'update']);

// Model CRUD
Route::apiResource('/modeles', ModeleController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/modeles/{id}', [ModeleController::class, 'update']);

// Categorie CRUD
Route::apiResource('/categories', CategorieController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/categories/{id}', [CategorieController::class, 'update']);

// Garantie CRUD
Route::apiResource('/garanties', GarantieController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/garanties/{id}', [GarantieController::class, 'update']);

// Produit CRUD
Route::apiResource('/produits', ProduitController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/produits/{id}', [ProduitController::class, 'update']);

// ImageProduit CRUD
Route::apiResource('/imageproduits', ImageProduitController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/imageproduits/{id}', [ImageProduitController::class, 'update']);

// Garantie Produit CRUD
Route::apiResource('/garantieproduits', GarantieProduitController::class)->only(['index', 'store', 'destroy', 'show']);
Route::post('/garantieproduits/{id}', [GarantieProduitController::class, 'update']);
