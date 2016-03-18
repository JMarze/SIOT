<?php

use Illuminate\Database\Seeder;

class MunicipioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->insert([
            'codigo' => '020301',
            'nombre' => 'Corocoro',
            'simbologia' => 'MDS',
            'fecha_legal' => '1856-03-29',
            'provincia_codigo' => '0203',
        ]);
        DB::table('municipios')->insert([
            'codigo' => '020306',
            'nombre' => 'Waldo Ballivián',
            'simbologia' => 'ML',
            'fecha_legal' => '1989-02-21',
            'provincia_codigo' => '0203',
        ]);
        DB::table('municipios')->insert([
            'codigo' => '021306',
            'nombre' => 'Colquencha',
            'simbologia' => 'ML',
            'fecha_legal' => '1990-12-14',
            'provincia_codigo' => '0213',
        ]);
    }
}
