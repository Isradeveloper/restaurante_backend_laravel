<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CategoriaProducto extends Model
{
    use HasFactory;
    protected $table = 'categoria_producto';

    /**
     * Get all of the producto for the CategoriaProducto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function producto(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_producto');
    }
}
