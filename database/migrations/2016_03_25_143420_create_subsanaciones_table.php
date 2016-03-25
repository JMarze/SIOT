<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsanacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsanaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nota', 25);
            $table->string('documentos', 25)->nullable();

            $table->timestamp('created_at');

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
        Schema::drop('subsanaciones');
    }
}
