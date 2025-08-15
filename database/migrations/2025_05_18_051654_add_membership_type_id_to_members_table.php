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
            //$table->unsignedBigInteger('membership_type_id')->nullable()->after('total_visitas');
    
            //$table->foreign('membership_type_id')
              //    ->references('id')->on('membership_types')
                //  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
};
