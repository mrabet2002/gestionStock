<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "id_categorie",
        "id_marque",
        "id_fournisseur",
        "id_user",
        "libele",
        "code_barre",
        "description",
        "image",
        "min_stock",
        "prix_initial",
        "poids",
        "unite",
        "zone",
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the stocks for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    /**
     * Get the categorie that owns the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }
    /**
     * Get the marque that owns the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marque()
    {
        return $this->belongsTo(Marque::class, 'id_marque');
    }
    /**
     * Get the fournisseur that owns the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }
}
