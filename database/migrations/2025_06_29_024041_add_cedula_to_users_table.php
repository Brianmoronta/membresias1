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
    Schema::table('users', function (Blueprint $table) {
        $table->string('cedula')->nullable()->unique()->after('idsucursal');
    });
  }

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('cedula');
    });
}

};
