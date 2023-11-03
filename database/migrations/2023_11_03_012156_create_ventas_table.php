<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_domicilio')->references('id')->on('domicilio');
            $table->foreignId('id_metodo_pago')->references('id')->on('metodo_pago');
            $table->foreignId('id_usuario')->references('id')->on('usuario');
            $table->foreignId('id_estado_venta')->references('id')->on('estado_venta');
            $table->foreignId('id_cliente')->references('id')->on('cliente');
            $table->unsignedDecimal('total');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
