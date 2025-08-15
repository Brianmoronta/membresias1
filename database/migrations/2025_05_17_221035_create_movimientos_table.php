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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
        
            // Relación por membership_number
            $table->string('membership_number'); // clave externa lógica
            $table->foreign('membership_number')
                ->references('membership_number')
                ->on('members')
                ->onDelete('cascade');
        
            $table->decimal('monto', 10, 2);
            $table->string('concepto')->nullable();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
