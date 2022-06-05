<?php

namespace App\Exports;

use App\Models\Marque;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProduitsExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function headings():array
    {
        return[
            "ID",
            "Catégorie",
            "Marque",
            "Fournisseur",
            "Libele",
            "Code barre",
            "Description",
            "Min stock",
            "Prix initial",
            "Poids",
            "Unité",
            "Zone",
            "Créé à",
            "Màj à",
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $produits = Produit::select("ID",
            "id_categorie",
            "id_marque",
            "id_fournisseur",
            "libele",
            "code_barre",
            "description",
            "min_stock",
            "prix_initial",
            "poids",
            "unite",
            "zone",
            "created_at",
            "updated_at",
        )->find($this->request->produits);
        $produits->map(function($produit){
            $produit->id_categorie = Categorie::find($produit->id_categorie)->libele;
            $produit->id_marque = Marque::find($produit->id_marque)->libele;
            $produit->id_fournisseur = Fournisseur::find($produit->id_fournisseur)->name;
            $produit->created_at = Date::dateTimeToExcel($produit->created_at);
            $produit->updated_at = Date::dateTimeToExcel($produit->updated_at);
        });
        return $produits;
    }
}
