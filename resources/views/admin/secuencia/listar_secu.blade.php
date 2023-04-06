@extends('layouts.app')
@section('contenido')
    <div class="row mt-1">
        <div class="col-0 col-lg-6 col-xxl-8 d-flex ">
            <div class="card">
                <div class="card-header bg-dark bg-gradient text-light">
                    <span> TABLA DE SECUENCIAS</span>
                </div>
                    <table class="table ">
                        <thead>
                            <tr class="table-secondary">
                                <th>ID_SECUENCIA</th>
                                <th>NOMBRE DE SECUENCIAS</th>
                                <th>ACCION REQUERIDA</th>
                            </tr>
                        </thead>
                        <tbody id="tablacontenido">
                            @foreach ($secuencias as $secuencia)
                                <tr>
                                    <td>{{ $secuencia->idsecuencia }}</td>
                                    <td>{{ $secuencia->nombre }}</td>
                                    <td><button id="btnMostrarFormulario">Mostrar formulario</button>
                                    </a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="divFormulario">
               
            </div>
        </div>
@endsection
