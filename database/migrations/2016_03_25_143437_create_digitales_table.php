<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigitalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digitales', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('a_utm')->default(false);
            $table->boolean('a_datum')->default(false);
            $table->boolean('a_zona')->default(false);
            $table->boolean('b_utm')->default(false);
            $table->boolean('b_datum')->default(false);
            $table->boolean('b_zona')->default(false);
            $table->boolean('c_utm')->default(false);
            $table->boolean('c_datum')->default(false);
            $table->boolean('c_zona')->default(false);

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
        Schema::drop('digitales');
    }
}
