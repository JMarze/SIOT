<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_solicitante', 100);
            $table->enum('tipo_limite', ['D', 'M']);
            $table->enum('estado', ['solicitud', 'revision', 'adicional', 'subsanación', 'admisión']);
            $table->string('informe_tecnico_legal', 25)->nullable();
            $table->string('nota_admision', 25)->nullable();
            $table->string('nota_subsanacion', 25)->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('solicitud_municipio', function (Blueprint $table) {
            $table->string('municipio_codigo', 6)->index();
            $table->foreign('municipio_codigo')->references('codigo')->on('municipios');
            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('solicitud_municipio');
        Schema::drop('solicitudes');
    }
}
