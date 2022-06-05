<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
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
        "num_client",
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
        "statut",
        "fichier_attacher",
    ];
    Protected $Dates = ['deleted_at'];
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the ventes for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventes()
    {
        return $this->hasMany(Vente::class, 'id_client');
    }
}
