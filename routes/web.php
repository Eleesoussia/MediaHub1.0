<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ========== PAGES PUBLIQUES ==========
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');

// ========== AUTH — ROUTES INVITÉ (guest) ==========
Route::middleware('guest')->group(function () {
    Route::get('/inscription', [AuthController::class, 'createInscription'])->name('inscription');
    Route::post('/inscription', [AuthController::class, 'storeInscription']);

    Route::get('/connexion', [AuthController::class, 'createConnexion'])->name('connexion');
    Route::post('/connexion', [AuthController::class, 'connecter']);
});

// ========== AUTH — DÉCONNEXION (connecté) ==========
Route::middleware('auth')->post('/deconnexion', [AuthController::class, 'deconnecter'])->name('deconnexion');

// ========== CONTENUS — LECTURE PUBLIQUE ==========
Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
Route::get('/contenus/{publication}', [ContenuController::class, 'show'])->name('contenus.show');

// ========== CATÉGORIES — LECTURE PUBLIQUE ==========
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');

// ========== CONTENUS — ÉCRITURE (auth) ==========
Route::middleware('auth')->group(function () {
    Route::get('/contenus/creer', [ContenuController::class, 'create'])->name('contenus.create');
    Route::post('/contenus', [ContenuController::class, 'store'])->name('contenus.store');
    Route::get('/contenus/{publication}/modifier', [ContenuController::class, 'edit'])->name('contenus.edit');
    Route::put('/contenus/{publication}', [ContenuController::class, 'update'])->name('contenus.update');
    Route::delete('/contenus/{publication}', [ContenuController::class, 'destroy'])->name('contenus.destroy');
});

// ========== CATÉGORIES — ÉCRITURE (auth, gate admin) ==========
Route::middleware('auth')->group(function () {
    Route::get('/categories/creer', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}/modifier', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');
});

// ========== ADMIN ==========
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])->name('dashboard');
});