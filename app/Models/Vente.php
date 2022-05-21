<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "id_user",
        "id_client",
        "id_facture",
        "total",
        "taxe",
        "description",
        "devise",
        "remise",
        "statut",
        "date_livraison",
        "cout_livraison",
        "adresse_livraison",
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get the user that owns the Achat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    /**
     * Get the client that owns the Vente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
    /**
     * Get the facture that owns the Vente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
    /**
     * The produits that belong to the Achat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_vente', 'id_vente', 'id_produit')
        ->withPivot('date_expiration', 'remise', 'qte_demandee', 'qte_livrai', 'taxe', 'prix', 'total');
    }
}
