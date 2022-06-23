<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
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
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
        Route::get('/dashboard/produits-non-pas-en-stock', [DashboardController::class, 'prosuitsNotInStock'])->name('dashboard.prosuitsNotInStock');
});

/* Produit routes */


Route::resource('produit', ProduitController::class)->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/produit/modifier-produit/{produit}', [ProduitController::class, 'update'])->name('produit.update')->middleware(['auth', 'role:responsable-achat,acheteur']); 
Route::post('/produit/supprimer-produit/{produit}', [ProduitController::class, 'destroy'])->name('produit.destroy')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/produit/export', [ProduitController::class, 'export'])->name('produit.export')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/produit/import', [ProduitController::class, 'import'])->name('produit.import')->middleware(['auth', 'role:responsable-achat,acheteur']);


/* Fournisseur routes */

Route::post('/produit/ajouter-produit/ajouter-fournisseur', [FournisseurController::class, 'storeFromModal'])->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::resource('fournisseur', FournisseurController::class)->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/fournisseur/modifier-fournisseur/{fournisseur}', [FournisseurController::class, 'update'])->name('fournisseur.update')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/fournisseur/supprimer-fournisseur/{fournisseur}', [FournisseurController::class, 'destroy'])->name('fournisseur.destroy')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/fournisseur/export', [FournisseurController::class, 'export'])->name('fournisseur.export')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/fournisseur/import', [FournisseurController::class, 'import'])->name('fournisseur.import')->middleware(['auth', 'role:responsable-achat,acheteur']);

/* Stock routes */

Route::resource('stock', StockController::class)->middleware(['auth']);
Route::post('/stock/supprimer-stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/stock/modifier-stock/{stock}', [StockController::class, 'update'])->name('stock.update')->middleware(['auth', 'role:responsable-achat,acheteur']);

/* Achat routes */
Route::resource('achat', AchatController::class)->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/achat/supprimer-achat/{achat}', [AchatController::class, 'destroy'])->name('achat.destroy')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/achat/modifier-achat/{achat}', [AchatController::class, 'update'])->name('achat.update')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/achat/recevoir-produits/{achat}', [AchatController::class, 'recevoirProduit'])->name('achat.recevoir_produits')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/achat/valoriser/{achat}', [AchatController::class, 'valoriser'])->name('achat.valoriser')->middleware(['auth', 'role:responsable-achat,acheteur']);

/* Clients routes */
Route::resource('client', ClientController::class)->middleware(['auth', 'role:responsable-vente,vendeur']);;
Route::post('/produit/ajouter-produit/ajouter-client', [ClientController::class, 'storeFromModal'])->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::post('/client/modifier-client/{client}', [ClientController::class, 'update'])->name('client.update')->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::post('/client/supprimer-client/{client}', [ClientController::class, 'destroy'])->name('client.destroy')->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::post('/client/export', [ClientController::class, 'export'])->name('client.export')->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::post('/client/import', [ClientController::class, 'import'])->name('client.import')->middleware(['auth', 'role:responsable-vente,vendeur']);

/* Vente routes */
Route::resource('vente', VenteController::class)->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::get('vente', [VenteController::class, 'index'])->name('vente.index')->middleware(['auth', 'role:responsable-vente,vendeur,expediteur']);
Route::get('vente/{vente}', [VenteController::class, 'show'])->name('vente.show')->middleware(['auth', 'role:responsable-vente,vendeur,expediteur']);
Route::post('/vente/supprimer-vente/{vente}', [VenteController::class, 'destroy'])->name('vente.destroy')->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::post('/vente/modifier-vente/{vente}', [VenteController::class, 'update'])->name('vente.update')->middleware(['auth', 'role:responsable-vente,vendeur']);
Route::get('/vente/gererStock/{vente}', [VenteController::class, 'gererStock'])->name('vente.gererStock')->middleware(['auth', 'role:responsable-vente,vendeur']);

Route::post('/vente/valider/{vente}', [VenteController::class, 'validerVente'])->name('vente.validerVente')->middleware(['auth', 'role:responsable-vente,expediteur']);
Route::post('/vente/valider-ventes', [VenteController::class, 'validerVentes'])->name('vente.validerVentes')->middleware(['auth', 'role:responsable-vente,expediteur']);


/* Categorie routes */
Route::resource('categorie', CategorieController::class)->middleware(['auth', 'role:responsable-achat,acheteur']);;
Route::post('/produit/ajouter-produit/ajouter-categorie', [CategorieController::class, 'storeFromModal'])->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/categorie/modifier-categorie/{categorie}', [CategorieController::class, 'update'])->name('categorie.update')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/categorie/supprimer-categorie/{categorie}', [CategorieController::class, 'destroy'])->name('categorie.destroy')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/categorie/export', [CategorieController::class, 'export'])->name('categorie.export')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/categorie/import', [CategorieController::class, 'import'])->name('categorie.import')->middleware(['auth', 'role:responsable-achat,acheteur']);

/* Marque routes */
Route::resource('marque', MarqueController::class)->middleware(['auth', 'role:responsable-achat,acheteur']);;
Route::post('/produit/ajouter-produit/ajouter-marque', [MarqueController::class, 'storeFromModal'])->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/marque/modifier-marque/{marque}', [MarqueController::class, 'update'])->name('marque.update')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/marque/supprimer-marque/{marque}', [MarqueController::class, 'destroy'])->name('marque.destroy')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/marque/export', [MarqueController::class, 'export'])->name('marque.export')->middleware(['auth', 'role:responsable-achat,acheteur']);
Route::post('/marque/import', [MarqueController::class, 'import'])->name('marque.import')->middleware(['auth', 'role:responsable-achat,acheteur']);

/* Facture routes */
Route::resource('facture', FactureController::class)->middleware(['auth', 'role:comptable']);;
Route::post('/facture/modifier-facture/{facture}', [FactureController::class, 'update'])->name('facture.update')->middleware(['auth', 'role:comptable']);
Route::post('/facture/supprimer-facture/{facture}', [FactureController::class, 'destroy'])->name('facture.destroy')->middleware(['auth', 'role:comptable']);

Route::post('/facture/valider/{facture}', [FactureController::class, 'validerFacture'])->name('facture.validerFacture')->middleware(['auth', 'role:comptable']);
Route::post('/facture/valider-factures', [FactureController::class, 'validerFactures'])->name('facture.validerFactures')->middleware(['auth', 'role:comptable']);