<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    /**
     * Get all of the produits for the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}
