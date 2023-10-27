<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';

    public function tipo_identificacion(): BelongsTo
    {
        return $this->belongsTo(TipoIdentificacion::class, 'id_tipo_identificacion');
    }

    /**
     * Get all of the direccion for the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function direccion(): HasMany
    {
        return $this->hasMany(DireccionCliente::class, 'id_cliente',);
    }
}
