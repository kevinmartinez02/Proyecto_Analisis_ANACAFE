<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registro_actividades_empleados', function (Blueprint $table) {
            $table->dropForeign(['id_lote']);

            $table->foreign('id_lote')
                  ->references('id')
                  ->on('lotes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registro_actividades_empleados', function (Blueprint $table) {
            //
        });
    }
};
