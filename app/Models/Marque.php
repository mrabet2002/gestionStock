<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_user",
        "libele",
        "logo",
        "description",
    ];
    /**
     * Get all of the produits for the Marque
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
