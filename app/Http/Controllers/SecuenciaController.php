<?php

namespace App\Http\Controllers;

use App\Models\Secuencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SecuenciaController extends Controller
{
    public function index()
    {

        //ACA MANDAMOS A LISTAR TODO LOS DATOS QUE SE ENCUENTRAN EN LA BASE DE DATOS

        //$secuencias = Secuencia::orderBy('idsecuencia','ASC')->with('secuencias')->get();

        $secuencias = DB::table('secuencias')->orderBy('idsecuencia','ASC')->get();
        return view('admin.secuencia.listar_secu',['secuencias' => $secuencias]);
    }

    public function edit(Secuencia $secuencia)
    {

        return view('admin.secuencia.edit', compact('secuencia'));

    }

    public function show($idsecuencia)
    {

        $secuencia = Secuencia::find($idsecuencia);
        echo $secuencia->nombre;
    }

    public function update(Request $request, Secuencia $secuencia)
    {
        $secuencia->nombre = $request->input('nombre');
        $secuencia->save();
        return redirect(route('admin '));

    }




}
