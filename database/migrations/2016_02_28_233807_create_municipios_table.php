<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->string('codigo', 6)->primary();
            $table->string('nombre', 50);
            $table->string('capital', 50);
            $table->string('ley', 10);
            $table->date('fecha_ley')->nullable();
            $table->boolean('proceso_2150')->default(false);

            $table->string('provincia_codigo', 4)->index();
            $table->foreign('provincia_codigo')->references('codigo')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('municipios');
    }
}
