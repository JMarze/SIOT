<?php

use Illuminate\Database\Seeder;

class ProvinciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provincias')->insert([
            'codigo' => '0203',
            'nombre' => 'Pacajes',
            'departamento_codigo' => '02',
        ]);
        DB::table('provincias')->insert([
            'codigo' => '0213',
            'nombre' => 'Aroma',
            'departamento_codigo' => '02',
        ]);
    }
}
