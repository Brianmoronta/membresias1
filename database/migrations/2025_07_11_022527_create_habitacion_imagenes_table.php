<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_create_habitacion_imagenes_table.php
public function up()
{
    Schema::create('habitacion_imagenes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('habitacion_id')->constrained()->onDelete('cascade');
        $table->string('ruta'); // aquí va la imagen
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacion_imagenes');
    }
};
