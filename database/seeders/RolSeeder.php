<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar los roles en la tabla rol
        \DB::table('rol')->insert([
            [
                'id_rol' => 1,
                'nombre' => 'Decano',
                'descripcion' => 'Decano de la universidad'
            ],
            [
                'id_rol' => 2,
                'nombre' => 'Docente',
                'descripcion' => 'Docente de la universidad'
            ],
            [
                'id_rol' => 3,
                'nombre' => 'Administrador',
                'descripcion' => 'Administrador de la universidad'
            ]
        ]);
    }
}
