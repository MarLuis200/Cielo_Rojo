<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Administrador;

class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'nombre' => 'Luis',
            'apellido_paterno' => 'Martínez',
            'apellido_materno' => 'Martínez',
            'direccion' => 'Valle de Bravo, Edo. Méx.',
            'telefono' => '5555555555',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
            'tipo_usuario' => 'administrador',
        ]);

        Administrador::create(['user_id' => $admin->id]);
    }
}
