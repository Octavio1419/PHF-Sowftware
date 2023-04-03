<?php

namespace Database\Seeders;

use App\Models\ejemploGraficas;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjemploGraficasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $datatime = Carbon::now();
        $datos = [
            array('control'=> '1', 'tempin'=>'15', 'tempout'=>'60', 'conductividad'=> '90', 'datetime'=> $datatime),

        ];
        ejemploGraficas::insert($datos);


        // DB::table('ejemplo_graficas')->insert([
        //     'nombre'=> 'Compresor',
        //     'temperatura'=> '50',
        //     'flujo'=> '20'
        // ]);

        // DB::table('ejemplo_graficas')->insert([
        //     'nombre' => 'Tablero X',
        //     'temperatura' => '20',
        //     'flujo' => '23.5'
        // ]);

        // DB::table('ejemplo_graficas')->insert([
        //     'nombre' => 'bomba atomica',
        //     'temperatura' => '120',
        //     'flujo' => '60'
        // ]);

        // DB::table('ejemplo_graficas')->insert([
        //     'nombre' => 'Valvula',
        //     'temperatura' => '150',
        //     'flujo' => '2.64'
        // ]);
        // DB::table('ejemplo_graficas')->insert([
        //     'nombre' => 'Tablero Y',
        //     'temperatura' => '120',
        //     'flujo' => '80'
        // ]);
    }
}
