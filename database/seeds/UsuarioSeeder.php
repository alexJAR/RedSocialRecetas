<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Alexis',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://misitio-ar.netlify.app/',
        ]);
        $user->perfil()->create();

        $user2 = User::create([
            'name' => 'Jair',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://misitio-ar.netlify.app/',
        ]);
        $user2->perfil()->create();


        /*DB::table('users')->insert([
            'name' => 'Alexis',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://misitio-ar.netlify.app/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);*/
    }

}
