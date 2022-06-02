<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProduitVente extends Pivot
{
    /**
     * Get the stock that owns the ProduitVente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock');
    }
}
