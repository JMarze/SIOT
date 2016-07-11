<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosDigitalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_digitales', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
        });

        Schema::create('etapa_inicio_documento_digital', function (Blueprint $table) {
            $table->string('etapa_inicio_codigo', 40)->index();
            $table->foreign('etapa_inicio_codigo')->references('codigo')->on('etapa_inicio');

            $table->integer('documento_digital_id')->unsigned();
            $table->foreign('documento_digital_id')->references('id')->on('documentos_digitales');

            $table->boolean('cumple')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('etapa_inicio_documento_digital');
        Schema::drop('documentos_digitales');
    }
}
