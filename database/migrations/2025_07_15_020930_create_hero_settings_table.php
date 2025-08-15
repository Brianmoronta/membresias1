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
    Schema::create('hero_settings', function (Blueprint $table) {
        $table->id();
        $table->string('titulo')->nullable();
        $table->string('subtitulo')->nullable();
        $table->string('imagen')->nullable(); // Imagen de fondo
        $table->string('boton_texto')->nullable();
        $table->string('boton_url')->nullable();
        $table->boolean('mostrar_boton')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_settings');
    }
};
