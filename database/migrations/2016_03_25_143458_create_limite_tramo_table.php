<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimiteTramoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limite_tramo', function (Blueprint $table) {
            $table->increments('id');
            $table->double('distancia', 9, 3);
            $table->integer('vertices');
            $table->text('municipios');

            $table->string('etapa_inicio_codigo', 40)->index();
            $table->foreign('etapa_inicio_codigo')->references('codigo')->on('etapa_inicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('limite_tramo');
    }
}
