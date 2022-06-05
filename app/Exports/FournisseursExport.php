<?php

namespace App\Exports;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class FournisseursExport implements FromCollection, WithHeadings
{
    public function __construct(Request $request) {
        $this->fournisseurs = $request->fournisseurs;
    }
    public function headings():array
    {
        return[
            "ID",
            "N Fournisseur",
            "Nom",
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
        $fournisseurs = Fournisseur::select(
            "id",
            "num_fournisseur",
            "name",
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
        )->find($this->fournisseurs);
        $fournisseurs->map(function($fournisseur){
            $fournisseur->created_at = Date::dateTimeToExcel($fournisseur->created_at);
            $fournisseur->updated_at = Date::dateTimeToExcel($fournisseur->updated_at);
        });
        return $fournisseurs;
    }
}
