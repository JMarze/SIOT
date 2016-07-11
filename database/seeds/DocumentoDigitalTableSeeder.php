<?php

use Illuminate\Database\Seeder;

class DocumentoDigitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Adecuación del Proceso 2150 a la Ley Nº 339',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Solicitud de delimitación por límite y/o tramo intradepartamental',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Fotocopia de cédula de identidad del solicitante',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Resolución del Concejo Municipal que acredite el nombramiento de la alcaldesa o alcalde',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Convenios, actas de conciliación u otro documento de respaldo que sirva para la delimitación',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Fotocopias legalizadas o fotocopias simples de las normas legales de creación o existencia de la unidad territorial',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Mapa referencial de ubicación de la unidad territorial según la ex división político administrativa de Bolivia sobre mapas topográficos oficiales editados por el Instituto Geográfico Militar a escala 1:50.000, en caso de no existir ésta, a escala 1:100.000',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Identificación y descripción de la toponimia cuando se trate de elementos físicos, arcifinios o naturales del límite solicitado',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Mapa y cobertura digital de tramo y vértices codificados en formato SIG',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Listado de coordenadas geodésicas y UTM, de acuerdo a formato establecido en las normas técnicas, en hoja electrónica',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Listado con coordenadas georreferenciadas de las comunidades, localidades y poblaciones que se encuentran dentro de la unidad territorial, en hoja electrónica',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Compromiso de pago para los trabajos de demarcación',
        ]);
    }
}
