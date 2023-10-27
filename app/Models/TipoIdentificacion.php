<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoIdentificacion extends Model
{
    use HasFactory;
    protected $table = 'tipo_identificacion';

    /**
     * Get all of the cliente for the TipoIdentificacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cliente(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id_tipo_identificacion');
    }
}
