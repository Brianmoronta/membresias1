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
        Schema::table('members', function (Blueprint $table) {
            $table->string('cedula')->nullable();
            $table->text('preferencia_alimenticia')->nullable();
            $table->date('fecha_membresia')->nullable();
            $table->decimal('descuento_membresia', 10, 2)->default(0);
            $table->string('enlace_pago')->nullable();
            $table->decimal('costo_membresia', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'cedula',
                'preferencia_alimenticia',
                'fecha_membresia',
                'descuento_membresia',
                'enlace_pago',
                'costo_membresia'
            ]);
        });
    }
};
