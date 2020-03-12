<?php

use Illuminate\Database\Seeder;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sucursales')->insert([
            'nombre' => 'Chillan',
            'clave' => bcrypt('BoticaChillanNG')
          ]);
  
          DB::table('sucursales')->insert([
            'nombre' => 'Coyhaique',
            'clave' => bcrypt('BoticaCoyNG')
          ]);
  
          DB::table('sucursales')->insert([
            'nombre' => 'Aysen',
            'clave' => bcrypt('BoticaAysenNG')
          ]);
    }
}
