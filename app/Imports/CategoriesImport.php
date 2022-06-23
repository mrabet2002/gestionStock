<?php

namespace App\Imports;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoriesImport implements ToModel, WithHeadingRow
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
        return new Categorie([
            "id_user" => $this->request->user()->id,
            "libele" => $row['libele'],
            "description" => $row['description'],
        ]);
    }
}
