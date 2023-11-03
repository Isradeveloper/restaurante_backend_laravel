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
        Schema::create('repartidor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tipo_identificacion')->references('id')->on('tipo_identificacion');
            $table->string('nombre');
            $table->string('email');
            $table->string('celular');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repartidor');
    }
};
