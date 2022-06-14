<?php

namespace App\Imports;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FournisseursImport implements ToModel, WithHeadingRow
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
        $num_fournisseur = $row['num_fournisseur'] && !Fournisseur::where('num_fournisseur', $row['num_fournisseur'])->exists() ? $row['num_fournisseur'] : Fournisseur::get()->max('num_fournisseur') + 1;
        return new Fournisseur([
            "id_user" => $this->request->user()->id,
            "num_fournisseur" => $num_fournisseur,
            "name" => $row['nom'],
            "email" => $row['email'],
            "tel" => $row['tel'],
            "site_web" => $row['site_web'],
            "adresse" => $row['adresse'],
            "code_postal" => $row['code_postal'],
            "pays" => $row['pays'],
            "ville" => $row['ville'],
            "description" => $row['description'],
            "devise" => $row['devise'],
        ]);
    }
}
