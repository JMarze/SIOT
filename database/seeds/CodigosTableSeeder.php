<?php

use Illuminate\Database\Seeder;

class CodigosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codigos')->insert([
            'numero' => 1,
            'año' => 2016,
        ]);
    }
}
