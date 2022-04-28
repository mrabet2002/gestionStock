<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_produit",
        "prix_vente",
        "prix_achat",
        "prix_vente_cons",
        "qte",
        "qte_disponible",
        "date_expiration",
        "descripiton",
    ];
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
