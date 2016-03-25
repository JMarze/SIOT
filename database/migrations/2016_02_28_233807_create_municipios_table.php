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
            $table->string('nombre', 50)->unique();
            $table->enum('simbologia', ['Asamblea', 'CCDS', 'CCL', 'CDS', 'CL', 'CSD', 'CSL', 'DS', 'LC', 'Mapa', 'MD', 'MDS', 'ML', 'MR', 'MSL'])->nullable();
            $table->date('fecha_legal')->nullable();
            $table->integer('ley_creacion')->nullable();
            $table->enum('ley_delimitacion', ['CL RC', 'LD', 'RC'])->nullable();
            $table->date('fecha_actual')->nullable();
            $table->integer('numero')->nullable();

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
