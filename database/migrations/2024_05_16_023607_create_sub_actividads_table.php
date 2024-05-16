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
        Schema::create('sub_actividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_actividad');
            $table->string('nombreActividad');
            $table->string('descripcion',350);
            $table->foreign('id_actividad')->references('id')->on('actividads');
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
        Schema::dropIfExists('sub_actividads');
    }
};
