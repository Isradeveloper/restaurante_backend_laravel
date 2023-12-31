<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class EstadoDomicilio extends Model
{
    use HasFactory;
    protected $table = 'estado_domicilio';

    /**
     * Get all of the domicilio for the estado_domicilio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function domicilio(): HasMany
    {
        return $this->hasMany(Domicilio::class, 'id_domicilio');
    }
}
