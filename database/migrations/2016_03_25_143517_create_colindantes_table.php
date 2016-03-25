<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColindantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colindantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nota', 25)->nullable();
            $table->date('fecha_emision_nota')->nullable();

            $table->string('etapa_inicio_codigo', 40)->index();
            $table->foreign('etapa_inicio_codigo')->references('codigo')->on('etapa_inicio');
            $table->string('municipio_codigo', 6)->index();
            $table->foreign('municipio_codigo')->references('codigo')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colindantes');
    }
}
