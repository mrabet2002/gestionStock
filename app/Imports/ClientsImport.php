<?php

namespace App\Imports;

use App\Models\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
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
        $num_client = $row['num_client'] && !Client::where('num_client', $row['num_client'])->exists() ? $row['num_client'] : Client::get()->max('num_client') + 1;
        return new Client([
            "id_user" => $this->request->user()->id,
            "num_client" => $num_client,
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
            "statut" => $row['statut'],
        ]);
    }
}
