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
            $table->enum('simbologia', ['', 'Asamblea', 'CCDS', 'CCL', 'CDS', 'CL', 'CSD', 'CSL', 'DS', 'LC', 'Mapa', 'MD', 'MDS', 'ML', 'MR', 'MSL'])->default('');
            $table->date('fecha_legal');
            $table->integer('ley_creacion')->default(0);
            $table->enum('ley_delimitacion', ['', 'CL RC', 'LD', 'RC'])->default('');
            $table->date('fecha_actual');
            $table->integer('numero')->default(0);

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
