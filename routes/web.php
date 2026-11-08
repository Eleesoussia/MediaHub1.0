<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// === Pages statiques ===
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');

// === Contenus ===
Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
Route::get('/contenus/creer', [ContenuController::class, 'create'])->name('contenus.create');
Route::post('/contenus', [ContenuController::class, 'store'])->name('contenus.store');
Route::get('/contenus/{publication}', [ContenuController::class, 'show'])->name('contenus.show');
Route::get('/contenus/{publication}/modifier', [ContenuController::class, 'edit'])->name('contenus.edit');
Route::put('/contenus/{publication}', [ContenuController::class, 'update'])->name('contenus.update');
Route::delete('/contenus/{publication}', [ContenuController::class, 'destroy'])->name('contenus.destroy');

// === Catégories ===
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/creer', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{categorie}/modifier', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{categorie}', [CategorieController::class, 'show'])->name('categories.show');