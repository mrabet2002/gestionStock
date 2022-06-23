<?php

namespace App\Exports;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection, WithHeadings
{
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function headings():array
    {
        return[
            "ID",
            "Libele",
            "Description",
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return Categorie::select(
            "id",
            "libele",
            "description",
        )->find($this->request->categories);
    }
}
