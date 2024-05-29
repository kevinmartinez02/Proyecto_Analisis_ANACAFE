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
            $table->dropForeign(['id_empleado']);
            $table->foreign('id_empleado')->references('id')->on('empleados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            // Revertir los cambios realizados en el método 'up'
            $table->dropColumn('nueva_columna');
            $table->string('direccion')->nullable(false)->change();
        });
        //
    }
};
