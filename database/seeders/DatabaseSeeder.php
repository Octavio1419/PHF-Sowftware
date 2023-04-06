<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(EjemploGraficasSeeder::class);

        //LLAMANDO LOS SEEDEER PARA QUE LOS LLEVE A LA BASE D E DATOS
        $this->call(UsuariosSeeder::class);
        $this->call(RolesSeeder::class);
    }
}
