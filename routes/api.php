<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\PublicationController;
use Illuminate\Support\Facades\Route;

// === Ping de test ===
Route::get('/ping', fn () => response()->json(['status' => 'ok', 'message' => 'MediaHub API is working!']));

// === Authentification ===
Route::post('/connexion', [AuthController::class, 'connexion']);

// === Catégories (lecture publique) ===
Route::get('/categories', [CategorieController::class, 'index']);

// === Publications ===
// Lecture publique
Route::get('/publications', [PublicationController::class, 'index']);
Route::get('/publications/{publication}', [PublicationController::class, 'show']);

// Écriture protégée
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/publications', [PublicationController::class, 'store']);
    Route::put('/publications/{publication}', [PublicationController::class, 'update']);
    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy']);

    Route::post('/deconnexion', [AuthController::class, 'deconnexion']);
    Route::get('/moi', [AuthController::class, 'moi']);
});