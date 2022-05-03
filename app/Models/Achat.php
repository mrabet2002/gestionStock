<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "id_user",
        "id_fournisseur",
        "total",
        "taxe",
        "created_at",
        "description",
        "devise",
        "remise",
        "statut",
        "date_reception"
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get the fournisseur that owns the Achat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }
    /**
     * Get the user that owns the Achat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    /**
     * The produits that belong to the Achat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'achat_produit', 'id_achat', 'id_produit')
        ->withPivot('date_expiration', 'remise', 'qte_demandee', 'qte_recu', 'taxe', 'prix', 'total');
    }
}
