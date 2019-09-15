<?php

use Illuminate\Database\Seeder;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pais')->insert([
            'description' => 'Colombia',
        ]);
        DB::table('pais')->insert([
            'description' => 'Argentina',
        ]);
        DB::table('pais')->insert([
            'description' => 'Brasil',
        ]);
    }
}
