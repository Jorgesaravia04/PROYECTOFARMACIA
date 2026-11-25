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
        $administratorRole = Role::firstOrCreate(
            ['name' => 'Administrador'],
            ['description' => 'Administrador del sistema']
        );

        User::firstOrCreate(
            ['email' => 'admin@sanjuan.com'],
            [
                'rol_id' => $administratorRole->id,
                'name' => 'Administrador',
                'dni' => '99999999',
                'password' => 'password',
            ]
        );
    }
}
