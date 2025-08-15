<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reservas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->date('fecha');
        $table->string('actividad');
        $table->text('comentario')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
