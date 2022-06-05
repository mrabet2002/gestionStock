<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Achat;
use App\Models\Stock;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $variablesToReturn = [];

        $stocks                     = $this->getProduitInfMinStock();
        $qteVendueParProduit        = $this->getQteVendueParProduit();
        $fournisseurs               = $this->getFournisseursStatistics();
        $produitsNotInStockCount    = $this->getProsuitsNotInStockCount();
        $produitsNotInStock         = $this->getProsuitsNotInStock(5);
        $moyenneAchats              = $this->getAchatsStatistics();
        $moyenneVentes              = $this->getVentesStatistics();

        $nbreClients = Client::select(DB::raw('count(*) as nbre_clients'))->first()->nbre_clients;
        $nbreFournisseurs = Fournisseur::select(DB::raw('count(*) as nbre_fournisseurs'))->first()->nbre_fournisseurs;
        $variablesToReturn = [
            'nbre_vente' => Vente::where('statut', 'Valider')->count(),
            'nbre_achat' => Achat::where('statut', 'Valoriser')->count(),
            'stocks'=> $stocks,
            'produitsNotInStock' => $produitsNotInStock,
            'produitsNotInStockCount' => $produitsNotInStockCount,
            'fournisseurs' => $fournisseurs,
            'qteVendueParProduit' => $qteVendueParProduit,
            'nbreClients' => $nbreClients,
            'nbreFournisseurs' => $nbreFournisseurs,
            'moyenneAchats' => $moyenneAchats->toArray(),
            'moyenneVentes' => $moyenneVentes->toArray(),
        ];

        return view('dashboard.index')->with($variablesToReturn);
    }
    public function prosuitsNotInStock()
    {
        return view('dashboard.prosuitsNotInStock')->with([
            'prosuitsNotInStock' => $this->getProsuitsNotInStock(),
        ]);
    }
    /* ===============================================R.Achat Dashboard Functions============================================== */
    /* 
        Produits au dessus le min stock
    */
    private function getProduitInfMinStock()
    {
        return Stock::join('produits', 'produits.id', '=', 'stocks.id_produit')
        ->join('fournisseurs', 'fournisseurs.id', '=', 'produits.id_fournisseur')
        ->select('id_produit', 'name as fournisseur' ,'libele', 'min_stock', DB::raw('sum(qte_disponible) as qte_total'))
        ->where('produits.min_stock', '>', 0)
        ->groupBy('id_produit')
        ->get()
        ->filter(function ($item)
        {
            return $item->min_stock >= $item->qte_total;
        });
    }
    /* 
        Quantite vendue par stock
    */
    private function getQteVendueParProduit()
    {
        $ventesValider = Vente::where('statut', 'Valider')->get();
        return $ventesValider->map(function($vente){
            return $vente->produits;
        })->collapse()->groupBy('id')->map(function($produits){
            $produit = $produits->first();
            $produit->qte_vendue = $produits->sum(function($produit){
                return $produit->pivot->qte_livrai;
            });
            return $produit;
        });
    }
    /* 
        retourner les produits 
        qui ne sont pas en stock
    */
    private function getProsuitsNotInStock()
    {   
        if($arg = func_get_args()){
            $produitsNotInStock = Produit::select(
                'id', 
                'id_categorie', 
                'id_marque', 
                'id_fournisseur',
                'libele'
            )->whereNotIn(
                    'id', Stock::select('id_produit')->get()
            )->limit($arg[0])->get();
        }else {
            $produitsNotInStock = Produit::select(
                'id', 
                'id_categorie', 
                'id_marque', 
                'id_fournisseur',
                'libele'
            )->whereNotIn(
                    'id', Stock::select('id_produit')->get()
            )->orderBy('libele', 'asc')->get();
        }
        return $produitsNotInStock;
    }
    /* 
        retourner le nombre de produits 
        qui ne sont pas en stock
    */
    private function getProsuitsNotInStockCount()
    {
        $produitsNotInStockCount = Produit::select(
            DB::raw('count(*) as raw_count')
        )->whereNotIn(
                'id', Stock::select('id_produit')->get()
        )->first();
        return $produitsNotInStockCount;
    }
    /* 
     */
    private function getFournisseursStatistics()
    {
        return DB::select(
            'SELECT 
            fournisseurs.* , 
            Format((sum(qte_recu)*100)/sum(qte_demandee), 2) as rapport_total 
            from achats inner JOIN achat_produit
            on achats.id = id_achat inner JOIN fournisseurs on id_fournisseur = fournisseurs.id
            WHERE qte_recu IS NOT NULL 
            AND YEAR(achats.date_reception) = YEAR(?)
            AND MONTH(achats.date_reception) = MONTH(?)
            GROUP BY id_fournisseur;',
            [Carbon::now(), Carbon::now()]
        );
    }
    /* 
     */
    private function getStockStatistics()
    {
        return DB::select('SELECT s.*, min_stock, libele , f.name as fournisseur
        FROM stocks s 
        INNER JOIN produits p ON s.id_produit = p.id 
        INNER JOIN fournisseurs f ON p.id_fournisseur = f.id
        WHERE s.qte <= p.min_stock AND p.id NOT IN
        (SELECT id_produit FROM stocks s INNER JOIN produits p
        ON s.id_produit = p.id WHERE s.qte > p.min_stock);');
    }
    /* 
     */
    private function getAchatsStatistics()
    {
        return Achat::where('statut', 'Valoriser')
        ->select('created_at', 'total')
        ->whereYear('created_at', Carbon::now())
        ->get()
        ->groupBy(function($achat){
            return Carbon::parse($achat->created_at)->format('m');
        })
        ->map(function($achats){
            return $achats->avg('total');
        });
    }
    /* 
     */
    private function getVentesStatistics()
    {
        return Vente::where('statut', 'Valider')
        ->select('created_at', 'total')
        ->whereYear('created_at', Carbon::now())
        ->get()
        ->groupBy(function($vente){
            return Carbon::parse($vente->created_at)->format('m');
        })
        ->map(function($ventes){
            return $ventes->avg('total');
        });
    }
    /* ===============================================R.Vente Dashboard Functions============================================== */
    private function getStocksAboutToExp()
    {
    }

}





/* Produit::with(['stocks', 'stocks.produit'])
->whereHas('stocks', function ($query)
{
    $query->where('min_stock', '>=', 'stocks.qte');
})->get(); */
/* Stock::select('s.id FROM stocks s INNER JOIN produits p
on s.id_produit = p.id WHERE s.qte <= p.min_stock and p.id not IN
(SELECT id_produit FROM stocks s INNER JOIN produits p
on s.id_produit = p.id WHERE s.qte > p.min_stock);')->get(); */