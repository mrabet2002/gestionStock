<?php

namespace App\Exports;

use App\Models\Client;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientsExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request) {
        $this->clients = $request->clients;
    }
    public function headings():array
    {
        return[
            "ID",
            "N client",
            "Nom",
            "Statut",
            "E-mail",
            "Tel",
            "Site Web",
            "Adresse",
            "Code Postal",
            "Pays",
            "Ville",
            "Description",
            "Devise",
            "Créé à",
            "Màj à",
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $clients = client::select(
            "id",
            "num_client",
            "name",
            "statut",
            "email",
            "tel",
            "site_web",
            "adresse",
            "code_postal",
            "pays",
            "ville",
            "description",
            "devise",
            "created_at",
            "updated_at",
        )->find($this->clients);
        $clients->map(function($client){
            $client->created_at = Date::dateTimeToExcel($client->created_at);
            $client->updated_at = Date::dateTimeToExcel($client->updated_at);
        });
        return $clients;
    }
}
