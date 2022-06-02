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
    /**
     * The ventes that belong to the Stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ventes(): BelongsToMany
    {
        return $this->belongsToMany(Vente::class, 'stock_vente', 'id_vente', 'id_stock');
    }
}
