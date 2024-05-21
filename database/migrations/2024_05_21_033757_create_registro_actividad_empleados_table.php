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
        Schema::create('registro_actividades_empleados', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_lote');
            $table->unsignedBigInteger('id_actividad');
            $table->unsignedBigInteger('id_sub_actividad');
            $table->unsignedBigInteger('id_rendimiento');
            $table->string('observaciones',300);
            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_lote')->references('id')->on('lotes');
            $table->foreign('id_actividad')->references('id')->on('actividads');
            $table->foreign('id_sub_actividad')->references('id')->on('sub_actividades');
            $table->foreign('id_rendimiento')->references('id')->on('tipo_rendimientos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_actividad_empleados');
    }
};
