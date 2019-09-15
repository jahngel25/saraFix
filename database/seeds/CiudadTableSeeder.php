<?php

use Illuminate\Database\Seeder;

class CiudadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ciudad')->insert([
            'description' => 'Bogota',
            'id_departamento' => 1,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Bojaca',
            'id_departamento' => 1,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Medellin',
            'id_departamento' => 2,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Andes',
            'id_departamento' => 2,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Anta',
            'id_departamento' => 3,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Cachi',
            'id_departamento' => 3,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Baradero',
            'id_departamento' => 4,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Bolivar',
            'id_departamento' => 4,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Agua Dose',
            'id_departamento' => 5,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Arabuta',
            'id_departamento' => 5,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Abatia',
            'id_departamento' => 6,
        ]);
        DB::table('ciudad')->insert([
            'description' => 'Andira',
            'id_departamento' => 6,
        ]);
    }
}
