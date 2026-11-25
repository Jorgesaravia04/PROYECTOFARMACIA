<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'Administrador'], ['description' => 'Administrador del sistema']);
        $pharmacist = Role::firstOrCreate(['name' => 'Químico farmacéutico'], ['description' => 'Gestión de medicamentos y reportes']);
        $cashier = Role::firstOrCreate(['name' => 'Cajero'], ['description' => 'Registro de ventas y atención de clientes']);

        $users = [
            ['admin@sanjuan.com', 'Administrador', '99999999', $admin->id],
            ['rquispe@sanjuan.com', 'Químico farmacéutico', '99999998', $pharmacist->id],
            ['cmendoza@sanjuan.com', 'Carlos Mendoza', '99999997', $cashier->id],
            ['ltorres@sanjuan.com', 'Lucía Torres', '99999996', $cashier->id],
        ];

        foreach ($users as [$email, $name, $dni, $roleId]) {
            User::firstOrCreate(
                ['email' => $email],
                ['rol_id' => $roleId, 'name' => $name, 'dni' => $dni, 'password' => 'password']
            );
        }
    }
}
