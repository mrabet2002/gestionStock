<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
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
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the produits for the Fournisseur
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits(): HasMany
    {
        
        return $this->hasMany(Produit::class);
    }
}
