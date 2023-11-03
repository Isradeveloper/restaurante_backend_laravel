<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Repartidor extends Model
{
    use HasFactory;
    protected $table = 'repartidor';

    public function tipo_identificacion(): BelongsTo
    {
        return $this->belongsTo(TipoIdentificacion::class, 'id_tipo_identificacion');
    }

    /**
     * Get all of the domicilio for the Repartidor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function domicilio(): HasMany
    {
        return $this->hasMany(Domicilio::class, 'id_domicilio');
    }

}