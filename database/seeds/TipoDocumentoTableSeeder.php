<?php

use Illuminate\Database\Seeder;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento')->insert([
            'description' => 'Cedula de Ciudadania',
        ]);
        DB::table('tipo_documento')->insert([
            'description' => 'Tarjeta de Identidad',
        ]);
        DB::table('tipo_documento')->insert([
            'description' => 'Pasaporte',
        ]);
        DB::table('tipo_documento')->insert([
            'description' => 'Cedula de Extrageria',
        ]);
        DB::table('tipo_documento')->insert([
            'description' => 'Nit',
        ]);
    }
}
