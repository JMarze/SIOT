<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpcionalToDocumentosDigitales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos_digitales', function (Blueprint $table) {
            $table->boolean('opcional')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos_digitales', function (Blueprint $table) {
            $table->dropColumn('opcional');
        });
    }
}
