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
            'nombre' => 'Coro Coro',
            'provincia_codigo' => '0203',
        ]);
        DB::table('municipios')->insert([
            'codigo' => '020306',
            'nombre' => 'Waldo Ballivián',
            'provincia_codigo' => '0203',
        ]);
        DB::table('municipios')->insert([
            'codigo' => '021306',
            'nombre' => 'Colquencha',
            'provincia_codigo' => '0213',
        ]);
    }
}
