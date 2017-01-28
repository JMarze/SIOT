<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEstadoToDocumentosDigitales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documento_digital_solicitud', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('documento_digital_adicional', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('documento_digital_subsanacion', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documento_digital_solicitud', function (Blueprint $table) {
            $table->enum('estado', ['revision', 'adicional', 'subsanacion', 'admision'])->default('revision');
        });

        Schema::table('documento_digital_adicional', function (Blueprint $table) {
            $table->enum('estado', ['revision', 'adicional', 'subsanacion', 'admision'])->default('revision');
        });

        Schema::table('documento_digital_subsanacion', function (Blueprint $table) {
            $table->enum('estado', ['revision', 'adicional', 'subsanacion', 'admision'])->default('revision');
        });
    }
}
