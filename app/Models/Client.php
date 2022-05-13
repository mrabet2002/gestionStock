<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
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
    public function getRouteKeyName()
    {
        return 'id';
    }
    /**
     * Get all of the vnetes for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vnetes(): HasMany
    {
        return $this->hasMany(Vente::class, 'id_client');
    }
}
