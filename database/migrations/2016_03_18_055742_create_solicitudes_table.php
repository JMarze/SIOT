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
            $table->string('documentos_solicitante', 25)->nullable();
            $table->string('documentos_tecnicos', 25)->nullable();

            $table->timestamp('created_at');
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
