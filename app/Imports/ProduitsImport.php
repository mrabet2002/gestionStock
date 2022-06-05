<?php

namespace App\Imports;

use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProduitsImport implements ToModel, WithHeadingRow
{
    public function __construct(Request $request) {
        $this->request = $request;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fournisseur = Fournisseur::where('num_fournisseur', $row['num_fournisseur']) ? Fournisseur::where('num_fournisseur', $row['num_fournisseur'])->first()->id : null;
        return new Produit([
            "id_fournisseur" => $fournisseur,
            "id_user" => $this->request->user()->id,
            "libele" => $row['libele'],
            "code_barre" => $row['code_barre'],
            "description" => $row['description'],
            "min_stock" => $row['min_stock'],
            "prix_initial" => $row['prix_initial'],
            "poids" => $row['poids'],
            "unite" => $row['unite'],
            "zone" => $row['zone'],
        ]);
    }
}
