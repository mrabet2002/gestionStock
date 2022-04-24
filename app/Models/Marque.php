<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;
    /**
     * Get all of the produits for the Marque
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
}
