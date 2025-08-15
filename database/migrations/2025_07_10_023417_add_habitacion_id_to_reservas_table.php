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
    Schema::table('reservas', function (Blueprint $table) {
        $table->unsignedBigInteger('habitacion_id')->nullable()->after('guests');
       $table->foreign('habitacion_id')
      ->references('id')
      ->on('habitacions') // 👈 así mismo como aparece en la base de datos
      ->onDelete('cascade');

    });
}


    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::table('reservas', function (Blueprint $table) {
        $table->dropForeign(['habitacion_id']);
        $table->dropColumn('habitacion_id');
    });
}

};
