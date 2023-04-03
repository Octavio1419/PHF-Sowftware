<?php

namespace App\Http\Controllers;

use App\Models\uno_cip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnoCipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = uno_cip::all();
        //dd($datos);

        $graficar = [];
        foreach ($datos as $dato){
            $graficar[]= ['horas' => (explode(" ", $dato['t_stamp']))[1], 'tempout'=> $dato['TEMP_SALIDA'], 'tempin'=> $dato['TEMP_ENTRADA'], 'conductividad'=> $dato['CONDUCTIVIDAD']];
        }
        $ejes = ['x' => "horas", 'y' => "temperaturas"];
        //dd($ejes['x']);


        return view('graficos.cliente', ['graficar'=> $graficar, 'ejes' => $ejes]);
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
    public function show(uno_cip $uno_cip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(uno_cip $uno_cip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, uno_cip $uno_cip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(uno_cip $uno_cip)
    {
        //
    }
}
