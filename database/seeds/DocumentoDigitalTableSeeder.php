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
            'opcional' => true,
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Solicitud de delimitación por límite y/o tramo [texto]',
            'articulo_inter' => 'Art. 32 I.',
            'articulo_intra' => 'Art. 66 I.',
            'texto_inter' => 'interdepartamental',
            'texto_intra' => 'intradepartamental',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Fotocopia de cédula de identidad del solicitante',
            'articulo_inter' => 'Art. 32 II. a.',
            'articulo_intra' => 'Art. 66 II. a.',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Resolución [texto] que acredite el nombramiento',
            'articulo_inter' => 'Art. 32 II. b.',
            'articulo_intra' => 'Art. 66 II. b.',
            'texto_inter' => 'de la Asamblea Departamental',
            'texto_intra' => 'del Concejo Municipal',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Fotocopias legalizadas o fotocopias simples de normas legales que sustenten la creación o existencia [texto]',
            'articulo_inter' => 'Art. 32 III. a.',
            'articulo_intra' => 'Art. 66 III. b.',
            'texto_inter' => 'del departamento y de los municipios ubicados en el límite interdepartamental',
            'texto_intra' => 'de la unidad territorial',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Convenios, actas de conciliación u otros documentos de respaldo que sirva para la delimitación de la unidad territorial',
            'articulo_inter' => 'Art. 32 III. b.',
            'articulo_intra' => 'Art. 66 III. a.',
            'opcional' => true,
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Mapa referencial de ubicación de la unidad territorial según la ex división político administrativa de Bolivia sobre mapas topográficos oficiales editados por el Instituto Geográfico Militar a escala 1:50.000, en caso de no existir ésta, a escala 1:100.000',
            'articulo_inter' => 'Art. 32 III. c.',
            'articulo_intra' => 'Art. 66 III. c.',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Identificación y descripción de la toponimia cuando se trate de elementos físicos, arcifinios o naturales del límite solicitado',
            'articulo_inter' => 'Art. 32 III. d.',
            'articulo_intra' => 'Art. 66 III. d.',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Mapa y cobertura digital de tramo y vértices codificados en formato SIG',
            'articulo_inter' => 'Art. 32 III. e.',
            'articulo_intra' => 'Art. 66 III. e.',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Listado de coordenadas geodésicas y UTM, de acuerdo a formato establecido en las normas técnicas, en hoja electrónica',
            'articulo_inter' => 'Art. 32 III. f.',
            'articulo_intra' => 'Art. 66 III. f.',
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Listado con coordenadas georreferenciadas de las comunidades, localidades y poblaciones [texto], en hoja electrónica',
            'articulo_inter' => 'Art. 32 III. g.',
            'articulo_intra' => 'Art. 66 III. g.',
            'texto_inter' => 'ubicadas en el límite',
            'texto_intra' => 'que se encuentran dentro de la unidad territorial'
        ]);
        DB::table('documentos_digitales')->insert([
            'descripcion' => 'Compromiso de pago para los trabajos de demarcación',
            'articulo_inter' => 'Art. 32 III. h.',
            'articulo_intra' => 'Art. 66 III. h.',
        ]);
    }
}
