<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ojovecinal.com'], // Puedes cambiarlo si deseas
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin1234'), // Cambia esta contraseña si lo deseas
                'is_admin' => true,
            ]
        );
    }
}
