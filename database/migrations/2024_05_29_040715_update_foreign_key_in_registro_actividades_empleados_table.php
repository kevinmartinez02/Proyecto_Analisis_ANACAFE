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
            $table->dropForeign(['id_sub_actividad']); // Elimina la restricción de clave externa existente
            $table->foreign('id_sub_actividad')
                  ->references('id')
                  ->on('sub_actividades')
                  ->onDelete('cascade'); // Agrega la opción ON DELETE CASCADE
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
