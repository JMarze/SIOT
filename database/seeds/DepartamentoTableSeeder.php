<?php

use Illuminate\Database\Seeder;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
            ['codigo' => '01', 'nombre' => 'Chuquisaca'],
            ['codigo' => '02', 'nombre' => 'La Paz'],
            ['codigo' => '03', 'nombre' => 'Cochabamba'],
            ['codigo' => '04', 'nombre' => 'Oruro'],
            ['codigo' => '05', 'nombre' => 'Potosí'],
            ['codigo' => '06', 'nombre' => 'Tarija'],
            ['codigo' => '07', 'nombre' => 'Santa Cruz'],
            ['codigo' => '08', 'nombre' => 'Beni'],
            ['codigo' => '09', 'nombre' => 'Pando']
        ]);
    }
}
