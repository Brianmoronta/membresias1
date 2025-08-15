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
    Schema::table('membership_types', function (Blueprint $table) {
        $table->decimal('costo_perdida', 10, 2)->nullable()->after('background_image')->default(0);
    });
}

public function down()
{
    Schema::table('membership_types', function (Blueprint $table) {
        $table->dropColumn('costo_perdida');
    });
}

};
