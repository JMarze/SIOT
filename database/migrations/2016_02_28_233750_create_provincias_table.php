<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            $table->string('codigo', 4)->primary();
            $table->string('nombre', 50);
            $table->date('fecha_ley')->nullable();

            $table->string('departamento_codigo', 2)->index();
            $table->foreign('departamento_codigo')->references('codigo')->on('departamentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('provincias');
    }
}
