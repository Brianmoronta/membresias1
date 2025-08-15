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
        Schema::create('caja_movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained('members')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('monto', 10, 2);
            $table->string('concepto');
            $table->enum('forma_pago', ['efectivo', 'tarjeta', 'transferencia', 'online', 'otro']);
            $table->string('referencia')->nullable(); // Para nº de transacción, nota, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_movimientos');
    }
};
