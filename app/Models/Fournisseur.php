<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory;
    Use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "id_user",
        "num_fournisseur",
        "name",
        "email",
        "tel",
        "site_web",
        "adresse",
        "code_postal",
        "pays",
        "ville",
        "description",
        "devise",
        "fichier_attacher",
    ];
    Protected $Dates = ['deleted_at'];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the produits for the Fournisseur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        
        return $this->hasMany(Produit::class, 'id_fournisseur');
    }
    /**
     * Get all of the achats for the Fournisseur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function achats()
    {
        return $this->hasMany(Achat::class, 'id_fournisseur');
    }
}
