<?php

use Illuminate\Database\Seeder;

class TrabajadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trabajadores')->insert([
            'rut' => '12345678-9',
            'nombre' => 'Samy',
            'ap_pat' => 'Angulo',
            'ap_mat' => 'Angulo',
            'telefono' => '987654321',
            'direccion' => 'freire',
            'n_direccion' => '659',
            'sucursales_id' => '2',
            'users_id' => '3',
          ]);
    }
}
