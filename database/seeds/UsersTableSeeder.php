<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'operador',
            'password' => bcrypt('operadorBNG'),
            'email' => 'operador@naturgest.com'
          ]);
    
          DB::table('users')->insert([
            'name' => 'administrador',
            'password' => bcrypt('adminBNG'),
            'email' => 'administrador@naturgest.com'
          ]);
    
            DB::table('users')->insert([
              'name' => 'gerente',
              'password' => bcrypt('gerenteBNG'),
            'email' => 'gerente@naturgest.com'
          ]);
    }
}
