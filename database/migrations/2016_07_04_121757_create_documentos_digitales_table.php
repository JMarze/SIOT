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
            $table->string('articulo_inter', 15)->nullable();
            $table->string('articulo_intra', 15)->nullable();
            $table->text('texto_inter')->nullable();
            $table->text('texto_intra')->nullable();
        });

        Schema::create('documento_digital_solicitud', function (Blueprint $table) {
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');

            $table->integer('documento_digital_id')->unsigned();
            $table->foreign('documento_digital_id')->references('id')->on('documentos_digitales');

            $table->enum('cumple', ['por revisar', 'si', 'no', 'no corresponde'])->default('por revisar');
            $table->integer('fojas_de')->default(0);
            $table->integer('fojas_a')->default(0);
            $table->string('archivo', 25)->nullable();
            $table->enum('estado', ['revision', 'adicional', 'subsanacion', 'admision'])->default('revision');
            $table->dateTime('fecha')->nullable();
            $table->text('observaciones')->nullable();
        });

        Schema::create('documento_digital_adicional', function (Blueprint $table) {
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');

            $table->integer('documento_digital_id')->unsigned();
            $table->foreign('documento_digital_id')->references('id')->on('documentos_digitales');

            $table->enum('cumple', ['por revisar', 'si', 'no', 'no corresponde'])->default('por revisar');
            $table->string('archivo', 25)->nullable();
            $table->enum('estado', ['revision', 'subsanacion', 'admision'])->default('revision');
            $table->dateTime('fecha')->nullable();
            $table->text('observaciones')->nullable();
        });

        Schema::create('documento_digital_subsanacion', function (Blueprint $table) {
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');

            $table->integer('documento_digital_id')->unsigned();
            $table->foreign('documento_digital_id')->references('id')->on('documentos_digitales');

            $table->enum('cumple', ['por revisar', 'si', 'no', 'no corresponde'])->default('por revisar');
            $table->string('archivo', 25)->nullable();
            $table->enum('estado', ['revision', 'admision'])->default('revision');
            $table->dateTime('fecha')->nullable();
            $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('documento_digital_solicitud');
        Schema::drop('documento_digital_adicional');
        Schema::drop('documento_digital_subsanacion');
        Schema::drop('documentos_digitales');
    }
}
