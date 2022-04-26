<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FournisseurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/* Produit routes */
Route::get('/produits', [ProduitController::class, 'index'])->name('produit.index')->middleware(['auth', 'role:responsable-achat']);
Route::get('/produits/afficher/{produit}', [ProduitController::class, 'show'])->name('produit.show')->middleware(['auth', 'role:responsable-achat']);
Route::get('/produit/ajouter-produit', [ProduitController::class, 'create'])->name('produit.create')->middleware(['auth', 'role:responsable-achat']);
Route::post('/produit/ajouter-produit', [ProduitController::class, 'store'])->name('produit.store')->middleware(['auth', 'role:responsable-achat']);
Route::post('/produit/supprimer-produit/{produit}', [ProduitController::class, 'destroy'])->name('produit.destroy')->middleware(['auth', 'role:responsable-achat']);
Route::get('/produit/modifier-produit/{produit}', [ProduitController::class, 'edit'])->name('produit.edit')->middleware(['auth', 'role:responsable-achat']);
Route::post('/produit/modifier-produit/{produit}', [ProduitController::class, 'update'])->name('produit.update')->middleware(['auth', 'role:responsable-achat']);

/* Fournisseur routes */
Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseur.index')->middleware(['auth', 'role:responsable-achat']);
Route::get('/fournisseur/ajouter-fournisseur', [FournisseurController::class, 'create'])->name('fournisseur.create')->middleware(['auth', 'role:responsable-achat']);
Route::post('/fournisseur/ajouter-fournisseur', [FournisseurController::class, 'store'])->name('fournisseur.store')->middleware(['auth', 'role:responsable-achat']);
Route::post('/fournisseur/supprimer-fournisseur/{fournisseur}', [FournisseurController::class, 'destroy'])->name('fournisseur.destroy')->middleware(['auth', 'role:responsable-achat']);
Route::get('/fournisseur/modifier-fournisseur/{fournisseur}', [FournisseurController::class, 'edit'])->name('fournisseur.edit')->middleware(['auth', 'role:responsable-achat']);
Route::post('/fournisseur/modifier-fournisseur/{fournisseur}', [FournisseurController::class, 'update'])->name('fournisseur.update')->middleware(['auth', 'role:responsable-achat']);