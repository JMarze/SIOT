<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(DepartamentoTableSeeder::class);
        $this->call(ProvinciaTableSeeder::class);
        $this->call(MunicipioTableSeeder::class);
        $this->call(DocumentoDigitalTableSeeder::class);
        $this->call(CodigosTableSeeder::class);
    }
}
