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
        $this->call(PaisTableSeeder::class);
        $this->call(DepartamentoTableSeeder::class);
        $this->call(CiudadTableSeeder::class);
        $this->call(TipoDocumentoTableSeeder::class);
    }
}
