<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePronunciamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pronunciamientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pronunciamiento', 25)->nullable();
            $table->string('documentos_observaciones', 25)->nullable();
            $table->string('compromiso_pago', 25);
            $table->enum('estado', ['conformidad', 'observacion'])->nullable();

            $table->integer('colindante_id')->unsigned();
            $table->foreign('colindante_id')->references('id')->on('colindantes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pronunciamientos');
    }
}
