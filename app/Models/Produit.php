<?php

namespace App\Models;

use App\Models\Vente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    Use SoftDeletes;
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
    Protected $Dates = ['deleted_at'];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the stocks for the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_produit');
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
    /**
     * The achats that belong to the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function achats()
    {
        return $this->belongsToMany(Achat::class);
    }
    /**
     * The ventes that belong to the Produit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ventes()
    {
        return $this->belongsToMany(Vente::class, 'produit_vente', 'id_vente', 'id_produit')
        ->withPivot('date_expiration', 'remise', 'qte_demandee', 'qte_livrai', 'taxe', 'prix', 'total');
    }
}
