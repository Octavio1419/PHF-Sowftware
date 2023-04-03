@extends('layouts.app')
@section('contenido')
    <div class="container-fluid">

        <div class="row mt-3">
            <h1 class="h3 mb-3"><strong> Graficas del 2020/06/17 </strong></h1>

            <div class="col">
                <div class="card flex-fill w-100">
                    <div class="card-header bg-dark bg-gradient text-light">
                        <span> DATOS </span>
                    </div>
                    <div class="card-body">

                        <ul class="list-group">
                            @foreach ($infos as $info )
                                <li class="list-group-item"> <strong> Fecha inicio: </strong> {{ $info['fecha_inicio'] }} </li>
                                <li class="list-group-item"> <strong> Fecha final: </strong> {{ $info['fecha_final'] }} </li>
                                <li class="list-group-item"> <strong> Hora inicio: </strong>  {{ $info['hora_inicio'] }} </li>
                                <li class="list-group-item"> <strong> Hora final: </strong>  {{ $info['hora_final'] }} </li>
                                <li class="list-group-item"> <strong> Duracion: </strong> {{ $info['duracion'] }} </li>
                                <li class="list-group-item"> <strong> Tipo de cip: </strong> {{ $info['tipo_cip'] }} </li>
                                <li class="list-group-item"> <strong> Usuario: </strong>  {{ $info['usuario'] }} </li>
                                <li class="list-group-item"> <strong> Equipo: </strong>  {{ $info['equipo'] }} </li>
                            @endforeach
                          </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card flex-fill w-100">
                    <div class="card-header bg-dark bg-gradient text-light">
                        <span> TABLA </span>
                    </div>
                    <div style='height:360px;overflow:auto' class="card-body" id="taula">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="table-secondary">
                                    <th>TIPO DE CIP</th>
                                    <th>INICIO</th>
                                    <th>FINAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datostabla as $datotabla)
                                    <tr>
                                        <td>{{ $datotabla['tipo_cip'] }} </td>
                                        <td> {{ $datotabla['inicio'] }} </td>
                                        <td> {{ $datotabla['final'] }} </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

        {{--  Para grafica de conductividad  --}}
        <div class="row mt-3">
            <div class="col-lg col-md col d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header bg-dark bg-gradient text-light">

                        <span> CONDUCTIVIDAD </span>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <div class="card-body py-3">
                                <div id="chart_conductividad"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-lg col-md col d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header bg-dark bg-gradient text-light">

                        <span> TEMPERATURAS </span>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <div class="card-body py-3">
                                <div id="dbchart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        var puntos = JSON.parse('{!! json_encode($graficar) !!}');
        console.log(puntos);

        var chart = c3.generate({

            bindto: '#chart_conductividad',
            data: {
                json: puntos,
                keys: {
                    x: 'horas',
                    value: ['conductividad'],
                }
            },

            point: {
                r: 0,
                //show: false,
                focus: {
                    expand: {
                        enabled: true,
                        r: 5
                    }
                },
            },
            axis: {
                x: {

                    type: 'categories', //timeseries
                    tick: {

                        fit: false,
                        //count:5,
                        centered: true,
                        format: '%H:%M:%S',
                        culling: {
                            max: 5
                        },
                        rotate: -45,
                        multiline: false


                    },

                    height: 80,

                    label: { // ADD
                        text: "{!! $ejes['x'] !!}",
                        position: 'middle'
                    }
                },
                y: {
                    label: { // ADD
                        text: "{!! $ejes['y2'] !!}",
                        position: 'outer-middle'
                    },


                }

            },
            grid: {
                x: {
                    //show: true,

                    {{--  lines: [{
                            value: 2
                        }, {
                            value: 4,
                            class: 'grid800',
                            text: 'LABEL 4'
                        },
                        {
                            value: 1,
                            text: 'Label 1'
                        },
                        {
                            value: 3,
                            text: 'Label 3',
                            position: 'middle'
                        },
                        {
                            value: 4.5,
                            text: 'Lable 4.5',
                            position: 'start'
                        }
                    ]  --}}

                    //lines: [{value: 2}, {value: 4, class: 'grid4', text: 'LABEL 4'} ]
                },
                y: {
                    //show: true
                }
            }
        });
    </script>

    <script>
        var puntos = JSON.parse('{!! json_encode($graficar) !!}');
        console.log(puntos);

        var chart = c3.generate({

            bindto: '#dbchart',
            data: {
                json: puntos,
                keys: {
                    x: 'horas',
                    value: ['tempout', 'tempin'],
                }
            },

            point: {
                r: 0,
                //show: false,
                focus: {
                    expand: {
                        enabled: true,
                        r: 5
                    }
                },
            },
            axis: {
                x: {

                    type: 'categories', //timeseries
                    tick: {

                        fit: false,
                        //count:5,
                        centered: true,
                        format: '%H:%M:%S',
                        culling: {
                            max: 5
                        },
                        rotate: -45,
                        multiline: false


                    },

                    height: 80,

                    label: { // ADD
                        text: "{!! $ejes['x'] !!}",
                        position: 'middle'
                    }
                },
                y: {
                    label: { // ADD
                        text: "{!! $ejes['y'] !!}",
                        position: 'outer-middle'
                    },


                }

            },
            grid: {
                x: {
                    //show: true,

                    {{--  lines: [{
                            value: 2
                        }, {
                            value: 4,
                            class: 'grid800',
                            text: 'LABEL 4'
                        },
                        {
                            value: 1,
                            text: 'Label 1'
                        },
                        {
                            value: 3,
                            text: 'Label 3',
                            position: 'middle'
                        },
                        {
                            value: 4.5,
                            text: 'Lable 4.5',
                            position: 'start'
                        }
                    ]  --}}

                    //lines: [{value: 2}, {value: 4, class: 'grid4', text: 'LABEL 4'} ]
                },
                y: {
                    //show: true
                }
            },
            zoom: {
                enabled: false
            },
        });
    </script>
@endsection
