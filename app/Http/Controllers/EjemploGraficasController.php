<?php

namespace App\Http\Controllers;

use App\Models\ejemploGraficas;
use Illuminate\Http\Request;

class EjemploGraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = ejemploGraficas::all();

        $temperaturaout =[];
        $temperaturain =[];
        $tiempo = [];
        $nombre=null;
        $conductividad=[];

        $table = [] ;
        $t1 = [];
        $t2 = [];
        $table[]="x";
        $t1[] = "tempOUT";
        $t2[] = "temIN";


        $puntos = [];
        foreach ($datos as $dato){
            $puntos[]=['horas' => (explode(" ", $dato['datetime']))[1], 'tempout'=> $dato['tempout'], 'tempin'=> $dato['tempin']];

            if($dato['control'] == "1"){
                $nombre = "CIP 1";
            }
            $temperaturaout[] =  $dato['tempout'];
            $temperaturain[] =  $dato['tempin'];
            $conductividad[] =  $dato['conductividad'];
            $tiempo[] = (explode(" ", $dato['datetime']))[1];

            $table[] = (explode(" ", $dato['datetime']))[1];
            $t1[] =  $dato['tempout'];
            $t2[] =  $dato['tempin'];
        }

       //dd($tiempo);
        return view('graficos.lineas', ['puntos'=>$puntos,'nombre'=>$nombre, 'temperaturaout' => $temperaturaout , 'temperaturain' => $temperaturain , 'conductividad'=> $conductividad ,'tiempo' => $tiempo ,
        'table'=>$table , 't1' => $t1, 't2' => $t2 ]);

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
