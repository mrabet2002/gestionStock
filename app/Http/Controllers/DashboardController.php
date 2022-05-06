<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Achat;
use App\Models\Stock;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $stocks = DB::select('SELECT s.*, min_stock, libele , f.name as fournisseur
        FROM stocks s 
        INNER JOIN produits p ON s.id_produit = p.id 
        INNER JOIN fournisseurs f ON p.id_fournisseur = f.id
        WHERE s.qte <= p.min_stock AND p.id NOT IN
        (SELECT id_produit FROM stocks s INNER JOIN produits p
        ON s.id_produit = p.id WHERE s.qte > p.min_stock);');

        $fournisseurs = DB::select(
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

        $stocks = collect($stocks);

        $produitsNotInStockCount = $this->getProsuitsNotInStockCount();
        $produitsNotInStock = $this->getProsuitsNotInStock(5);

        return view('dashboard.index')->with([
            'stocks'=> $stocks,
            'produitsNotInStock' => $produitsNotInStock,
            'produitsNotInStockCount' => $produitsNotInStockCount,
            'fournisseurs' => $fournisseurs
        ]);
    }
    public function prosuitsNotInStock()
    {
        return view('dashboard.prosuitsNotInStock')->with([
            'prosuitsNotInStock' => $this->getProsuitsNotInStock(),
        ]);
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