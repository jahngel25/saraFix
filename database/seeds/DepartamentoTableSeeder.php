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
        DB::table('departamento')->insert([
            'description' => 'Cundinamarca',
            'id_pais' => 1,
        ]);
        DB::table('departamento')->insert([
            'description' => 'Antioquia',
            'id_pais' => 1,
        ]);
        DB::table('departamento')->insert([
            'description' => 'San Juan',
            'id_pais' => 2,
        ]);
        DB::table('departamento')->insert([
            'description' => 'Buenos Aires',
            'id_pais' => 2,
        ]);
        DB::table('departamento')->insert([
            'description' => 'Sau Paulo',
            'id_pais' => 3,
        ]);
        DB::table('departamento')->insert([
            'description' => 'Parana',
            'id_pais' => 3,
        ]);

    }
}
