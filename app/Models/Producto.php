<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';

    public function categoria_producto(): BelongsTo
    {
        return $this->belongsTo(CategoriaProducto::class, 'id_categoria_producto');
    }
}
