<?php

namespace App\Http\Controllers;

use App\Models\uno_2020_04_24_cip;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class Uno20200424CipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $lis = DB::select('\dt');
        // foreach($lis as $table)
        // {
        //       echo $table->Tables_in_db_name;
        // }
        // dd($lis);


        // $h_inicio = DB::table('uno_2020_06_17_cips')->orderBy('hora')->first();

        $infos = DB::select('select max(fecha) Fecha_final , min(fecha) Fecha_inicio, max(hora) Hora_final, min(hora) Hora_inicio, (select max(hora) - min(hora) from uno_2020_06_17_cips) duracion ,(select tipo_cip maximo from uno_2020_06_17_cips group by tipo_cip order by maximo asc limit 1
        ) tipo_cip, (SELECT usuario FROM uno_2020_06_17_cips limit 1) usuario, (SELECT equipo FROM uno_2020_06_17_cips limit 1) equipo from uno_2020_06_17_cips;');
        $infos = json_decode(json_encode($infos), true);

        //dd($infos);
        // $h_inicio = DB::table('uno_2020_06_17_cips')->min('hora');
        // $h_final = DB::table('uno_2020_06_17_cips')->max('hora');
        // $h_i = new DateTime($h_inicio);
        // $h_f = new DateTime($h_final);
        // $duracion = ($h_i->diff($h_f))->format('%H:%i:%s');


        //Datos para la tabla
        $datostabla = DB::select('SELECT nombre tipo_cip, min(hora) inicio,max(hora) final FROM uno_2020_06_17_cips,secuencias
            WHERE uno_2020_06_17_cips.secuencia=secuencias.idsecuencia
            GROUP BY nombre');
        $datostabla = json_decode(json_encode($datostabla), true);

            //-> join('secuencias', 'secuencias.idsecuencia', '=', 'uno_2020_06_17_cips.secuencia')
            //->select('uno_2020_06_17_cips.*','secuencias.nombre', DB::raw('nombre as nombremodificado'))

            //->get();
            //-> join('secuencias', 'secuencias.idsecuencia', '=', 'uno_2020_06_17_cips.secuencia')
           // ->select('uno_2020_06_17_cips.*','secuencias.nombre')

           // DB::raw('MAX(created_at) as last_post_created_at')




        $datos  = (array) json_decode(DB::table('uno_2020_06_17_cips')->get(),true);
        //dd($datos);

        $graficar = [];
        $ejes = ['x' => "horas", 'y' => "temperaturas", 'y2' => 'Conductividad'];

        foreach ($datos as $dato){
            $graficar[]=['horas'=>$dato['hora'] ,'tempout'=>$dato['temp_ret'] ,'tempin'=> $dato['temp_sal'],'conductividad'=> $dato['conductividad']];

        }


        return view('graficos.old', ['graficar'=>$graficar, 'ejes'=>$ejes, 'infos'=>$infos, 'datostabla'=>$datostabla]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(uno_2020_04_24_cip $uno_2020_04_24_cip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(uno_2020_04_24_cip $uno_2020_04_24_cip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, uno_2020_04_24_cip $uno_2020_04_24_cip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(uno_2020_04_24_cip $uno_2020_04_24_cip)
    {
        //
    }
}
