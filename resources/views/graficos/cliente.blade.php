@extends('layouts.app')
@section('contenido')
    <main class="content">
        <h1 class="h3 mb-3"><strong> SISTEMA DE GRAFICACION </strong></h1>

        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0"> ZOOM MAUSE RUEDA </h5>
                </div>
                <div class="card-body py-3">
                    <div id="dbchart"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0"> ZOOM SELECTION </h5>
                </div>
                <div class="card-body py-3">
                    <div id="dbchart2"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0"> ZOOM SUBCHART </h5>
                </div>
                <div class="card-body py-3">
                    <div id="dbchart3"></div>
                </div>
            </div>
        </div>

    </main>

    <!-- Load c3.css -->
    <link href="css/c3/c3.css" rel="stylesheet">
    <!-- Load d3.js and c3.js -->
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script src="js/c3/c3.min.js"></script>


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
                enabled: true
                //type: 'drag'
            },
        });

    </script>

    {{--  SEGUNDO CHART  --}}
    <script>
        var puntos = JSON.parse('{!! json_encode($graficar) !!}');
        console.log(puntos);

        var chart = c3.generate({

            bindto: '#dbchart2',
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
                enabled: true,
                type: 'drag'
            },
        });

    </script>


    {{--  TERCER CHART  --}}
    <script>
        var puntos = JSON.parse('{!! json_encode($graficar) !!}');
        console.log(puntos);

        var chart = c3.generate({

            bindto: '#dbchart3',
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

            subchart: {
                show: true,
                size: {
                    height: 30
                },

                axis: {
                    x: {
                      show: true,

                    }
                }
            }


        });

    </script>
@endsection
