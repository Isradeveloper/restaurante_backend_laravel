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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria_producto')->references('id')->on('categoria_producto');
            $table->unsignedDecimal('precio');
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedInteger('stock');
            $table->string('imagen');
            $table->timestamps();
            $table->boolean('activo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
