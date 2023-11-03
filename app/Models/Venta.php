<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';

    /**
     * Get the domicilio that owns the Venta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domicilio(): BelongsTo
    {
        return $this->belongsTo(Domicilio::class, 'id_domicilio');
    }


    /**
     * Get the metodo_pago that owns the Venta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metodo_pago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago');
    }


    /**
     * Get the usuario that owns the Venta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


    /**
     * Get the estado_venta that owns the Venta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_venta(): BelongsTo
    {
        return $this->belongsTo(EstadoVenta::class, 'id_estado_venta');
    }


    /**
     * Get the cliente that owns the Venta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }


    /**
     * The productos that belong to the Venta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'detalle_venta', 'id_venta', 'id_producto');
    }
}
