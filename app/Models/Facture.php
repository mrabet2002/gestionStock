<?php

namespace App\Models;

use App\Models\Vente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "id_user",
        "num_facture",
        "date_echeance",
        "envoi",
        "statut_paiment",
        "methode_paiment",
        "tva",
        "remise",
        "montant_ht",
        "total_ttc",
        "net_payer",
        "description",
        "devise",
        "fichier_attacher",
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the ventes for the Facture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'id_facture');
    }
}
