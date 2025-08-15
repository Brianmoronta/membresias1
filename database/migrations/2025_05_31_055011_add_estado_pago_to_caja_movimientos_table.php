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
    Schema::table('caja_movimientos', function (Blueprint $table) {
        $table->enum('estado_pago', ['pendiente', 'confirmado', 'rechazado'])
              ->default('pendiente')
              ->after('forma_pago');

        $table->unsignedBigInteger('confirmado_por')->nullable()->after('estado_pago');
        $table->timestamp('fecha_confirmacion')->nullable()->after('confirmado_por');

        $table->foreign('confirmado_por')->references('id')->on('users')->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('caja_movimientos', function (Blueprint $table) {
        $table->dropForeign(['confirmado_por']);
        $table->dropColumn(['estado_pago', 'confirmado_por', 'fecha_confirmacion']);
    });
}


};
