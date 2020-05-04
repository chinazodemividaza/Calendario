<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',255);
            $table->text('descripcion',255);
            $table->string('color',20);
            $table->string('textColor',20);
            $table->datetime('start');
            $table->datetime('end');
            $table->date('diaInicio');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->integer('idLugar');
            $table->integer('ilimitado');
            $table->integer('horaInicioInt');
            $table->integer('horaFinInt');



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
        Schema::dropIfExists('eventos');
    }
}
