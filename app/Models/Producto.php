<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';

    public function categoria_producto(): BelongsTo
    {
        return $this->belongsTo(CategoriaProducto::class, 'id_categoria_producto');
    }


    /**
     * The ventas that belong to the Producto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ventas(): BelongsToMany
    {
        return $this->belongsToMany(Venta::class, 'detalle_venta', 'id_producto', 'id_venta');
    }

}
