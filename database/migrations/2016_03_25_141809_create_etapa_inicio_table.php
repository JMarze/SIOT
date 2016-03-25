<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtapaInicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapa_inicio', function (Blueprint $table) {
            $table->string('codigo', 40)->primary();
            $table->string('informe_tecnico_legal', 25)->nullable();
            $table->string('informe_pronunciamiento', 25)->nullable();
            $table->string('acta_cierre', 25)->nullable;
            $table->enum('estado', ['adicional', 'admision', 'subsanacion', 'pronunciamiento', 'informe pronunciamiento', 'coordinacion', 'cierre', 'archivo'])->nullable();
            $table->date('fecha_estado')->nullable();

            $table->integer('solicitud_id')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('etapa_inicio');
    }
}
