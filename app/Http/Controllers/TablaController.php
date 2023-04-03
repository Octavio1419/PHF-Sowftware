<?php

namespace App\Http\Controllers;

use App\Models\Tabla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablaController extends Controller
{

    public function index()
    {

        $tables = DB::select("SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema';");
        //dd($tables);

        $cips = (array) json_decode(DB::table('nom_cips')->get(), true);
        $equipos = (array) json_decode(DB::table('equipos')->get(), true);

        return view('clientes.index', ['cips' => $cips, 'equipos' => $equipos]);

       // return view('graficos.hola');

    }

    public function buscar($dbtabla)
    {
        $consultas = DB::select($dbtabla);
        $consultas = json_decode(json_encode($consultas), true);

        $datos = [];

        foreach ($consultas as $consulta) {
            $tabla = $consulta['tablename'];

            $datos[] = json_decode(json_encode(DB::select("select (select nombre from $tabla as t1 join nom_cips as t2 on t1.idcip=t2.id group by nombre) cip ,idlavados, tipo_cip, usuario, equipo, min(fecha) f_inicial, max(fecha) f_final, min(hora) hora_inicial, max(hora) hora_final,
            (select max(hora)-min(hora) duracion) from  $tabla group by idlavados,equipo,usuario,tipo_cip having tipo_cip != 'Ninguno' order by idlavados;
            ")), true);
        }
        //$otra = json($datos);

        if ($consultas != null) {
            return json_encode($datos);
        } else {
            return response()->json(['estado' => 'Fallido'], 200);
        }
    }


    public function show($datos)
    {
        $separados = explode("=", $datos); // Separando el string por = en substrings
        $separados = str_replace(' ', '', $separados); // Eliminando los espacios en blanco que hay en cada palabra

        // [0] -> idlavados
        // [1] -> nombre del cip
        // [2] -> fecha tabla
        // [3] -> equipo

        $tabla = $separados[1] . "_" . str_replace("-", "_", $separados[2]) . "_cips";
        $idlavados = $separados[0];
        //dd($tabla);

        $marcas = DB::select("WITH verSecuencias AS (SELECT secuencias.nombre,hora,Row_Number() OVER (ORDER BY hora) - Row_Number()
        OVER (PARTITION BY secuencias.nombre ORDER BY hora) AS Seq FROM $tabla
        inner join secuencias on $tabla.secuencia = secuencias.idsecuencia where idlavados = $idlavados)
        SELECT verSecuencias.nombre, Min(hora) AS inicio, (Max(hora)+ INTERVAL '00:00:10') AS fin
        FROM verSecuencias, marcas where verSecuencias.nombre = marcas.nombre GROUP BY verSecuencias.nombre, Seq ORDER BY inicio");
        $marcas = json_decode(json_encode($marcas), true);


        $points = [];
        foreach ($marcas as $marca) {
            $points[] = ['value' => $marca['inicio'], 'class' => 'black', 'text' => $marca['nombre']];
            $points[] = ['value' => $marca['fin'], 'class' => 'black'];
        }
        //$points = json_encode($points,true); No es necesario convertirlo a JSON aqui ya que en el blade se convertira
        //dd($points);

        $infos = DB::select("select (select max(hora) - min(hora) from $tabla where idlavados = $idlavados) duracion ,
        (select tipo_cip maximo from $tabla where idlavados = $idlavados group by tipo_cip having tipo_cip != 'Ninguno' order by maximo asc limit 1) tipo_cip,
         (SELECT usuario FROM $tabla where idlavados = $idlavados limit 1 ) usuario,
         (SELECT equipo FROM $tabla where idlavados = $idlavados limit 1 ) equipo,
         max(fecha) Fecha_final , min(fecha) Fecha_inicio, max(hora) Hora_final, min(hora) Hora_inicio from $tabla where idlavados = $idlavados;");
        $infos = json_decode(json_encode($infos), true);


        //Datos para la tabla
        $datostabla = DB::select("WITH verSecuencias AS (SELECT nombre,hora, Row_Number() OVER (ORDER BY hora) - Row_Number()
        OVER (PARTITION BY nombre ORDER BY hora) AS Seq FROM $tabla inner join secuencias on
        $tabla.secuencia = secuencias.idsecuencia where idlavados = $idlavados) SELECT nombre, Min(hora) AS inicio,
        (Max(hora)+ INTERVAL '00:00:10') AS fin FROM verSecuencias GROUP BY nombre, Seq ORDER BY inicio");

        $datostabla = json_decode(json_encode($datostabla), true);
        //dd($datostabla);

        $sentencia = DB::select("select * from $tabla where idlavados=$idlavados");
        $datos  = (array) json_decode(json_encode($sentencia), true);
        $graficar = [];

        $ejes = ['x' => "Horas", 'y' => "Temperaturas ", 'y2' => 'Conductividad'];
        $etiquetas = DB::table('etiquetas')->get();
        $etiquetas = json_decode(json_encode($etiquetas), true);
        $labels = [];
        foreach ($etiquetas as $etiqueta) {
            $labels[] = ['x' => $etiqueta['d1'], 'y' => $etiqueta['d2']];


            //dd($labels);

            foreach ($datos as $dato) {
                $graficar[] = ['horas' => $dato['hora'], $etiqueta['d1'] => $dato['temp_ret'], $etiqueta['d2'] => $dato['temp_sal'], 'conductividad' => $dato['conductividad']];
            }
        }

        return view('graficos.graficas', ['graficar' => $graficar, 'ejes' => $ejes, 'infos' => $infos, 'datostabla' => $datostabla, 'points' => $points, 'labels' => $labels]);
        //return redirect()->away('https://www.example.com')->with('_blank');

        // $url = "http://www.pakainfo.com";
        // echo "<script>window.open('".$url."', '_blank')</script>";

    }
}
