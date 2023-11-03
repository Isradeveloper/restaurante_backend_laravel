<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domicilio extends Model
{
    use HasFactory;
    protected $table = 'domicilio';

    /**
     * Get the repartidor that owns the Domicilio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repartidor(): BelongsTo
    {
        return $this->belongsTo(Repartidor::class, 'id_repartidor');
    }


    /**    
     * Get the estado_domicilio that owns the Domicilio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_domicilio(): BelongsTo
    {
        return $this->belongsTo(EstadoDomicilio::class, 'id_estado_domicilio');
    }


    /**
     * Get all of the venta for the Domicilio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venta(): HasMany
    {
        return $this->hasMany(Venta::class, 'id_venta');
    }
}
