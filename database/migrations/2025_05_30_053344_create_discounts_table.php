<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_discounts_table.php
        public function up()
        {
            Schema::create('discounts', function (Blueprint $table) {
                $table->id();
                $table->string('nombre'); // Ej: "Empleado COOPBUENO"
                $table->string('tipo_aplicacion')->default('global'); // 'global' o 'membresia'
                $table->decimal('porcentaje', 5, 2); // Ej: 20.00
                $table->timestamps();
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
