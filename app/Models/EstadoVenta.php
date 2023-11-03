<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoVenta extends Model
{
    use HasFactory;

    protected $table = 'estado_venta';

    /**
     * Get all of the venta for the EstadoVenta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venta(): HasMany
    {
        return $this->hasMany(Venta::class, 'id_venta');
    }
}
