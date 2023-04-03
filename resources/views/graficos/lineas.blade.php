@extends('layouts.app')
@section('contenido')
    <main class="content">
        <h1 class="h3 mb-3"><strong> TEMA </strong></h1>


        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">BASE DE DATOS LINEAS</h5>
                </div>
                <div class="card-body py-3">
                    <div id="gra"></div>
                </div>
            </div>
        </div>




        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Grfica de lineas 2023 </h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0"> TABLA DB CON C3 JS </h5>
                </div>
                <div class="card-body py-3">
                    <div id="dbchart"></div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0"> TABLA EJEMPLO ESTATICA C3 JS</h5>
                </div>
                <div class="card-body py-3">
                    <div id="chart"></div>
                </div>
            </div>
        </div>

    </main>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{--  <script src="https://code.highcharts.com/modules/series-label.js"></script>  --}}
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    {{--  <script src="https://code.highcharts.com/modules/export-data.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/modules/accessibility.js"></script>  --}}


    <script>
        var tempin = JSON.parse('{!! json_encode($temperaturain) !!}');
        var ydata = JSON.parse('{!! json_encode($temperaturaout) !!}');
        var conductividad = JSON.parse('{!! json_encode($conductividad) !!}');
        var xdata = JSON.parse('{!! json_encode($tiempo) !!}');

        Highcharts.chart('gra', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'TRES LINEAS'
            },
            subtitle: {
                text: 'PONER ALGO'
            },
            xAxis: {
                categories: xdata
            },
            yAxis: {
                title: {
                    text: 'Temperaturas (°C)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            tooltip: {
                crosshairs: true
            },

            series: [{
                name: '<b> {!! $nombre !!} </b>',
                data: ydata,
                xdata
            }, {
                name: '<b> {!! $nombre !!} </b>',
                data: tempin,
                xdata

            }, {
                name: '<b> {!! $nombre !!} </b>',
                data: conductividad,
                xdata

            }]
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            {{--  var datas = <?php echo json_encode($puntos); ?>;  --}}

            var xdata = JSON.parse('{!! json_encode($temperaturaout) !!}');
            var ydata = JSON.parse('{!! json_encode($tiempo) !!}');

            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ydata,
                    datasets: [{
                        label: "{!! $nombre !!}",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: xdata,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {

                                stepSize: 0
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>


    <!-- Load c3.css -->
    <link href="css/c3/c3.css" rel="stylesheet">
    <!-- Load d3.js and c3.js -->
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script src="js/c3/c3.min.js"></script>


    <script>
        {{--  var tempin = JSON.parse('{!! json_encode($temperaturain) !!}');
        var ydata = JSON.parse('{!! json_encode($temperaturaout) !!}');
        var conductividad = JSON.parse('{!! json_encode($conductividad) !!}');  --}}
        var xdata = JSON.parse('{!! json_encode($table) !!}');

        var puntos = JSON.parse('{!! json_encode($puntos) !!}');


        var t1 = JSON.parse('{!! json_encode($t1) !!}');
        var t2 = JSON.parse('{!! json_encode($t2) !!}');


        console.log(puntos);


        var chart = c3.generate({
            bindto: '#dbchart',
            data: {

                json: puntos,
                keys: {
                    x: 'horas', // it's possible to specify 'x' when category axis
                    value: ['tempout', 'tempin'],
                }


                {{--  x: 'x',
                xFormat: '%H:%M:%S',
                columns: [
                    xdata,
                    t1,t2
                    // ['sample', 30, 200, 100, 400, 150, 250],
                    //['data1', 30, 200, 100, 400, 150, 250],
                    //['data2', 130, 340, 200, 500, 250, 350]
                ]  --}}

                {{--  xs: {
                    't1': 'x',
                    't2': 'x',
                },
                columns: [
                    xdata,
                    t1,
                    t2
                ],  --}}


            },

            axis: {

                x: {
                    type: 'categories', //timeseries
                    tick: {
                        // count:100,
                        format: '%H:%M:%S'

                    },
                    label: { // ADD
                        text: 'x label',
                        position: 'middle'
                    }
                },
                y: {
                    label: { // ADD
                        text: 'Y Label',
                        position: 'outer-middle'
                    }
                }

            },
            grid: {
                x: {
                    //show: true,

                    lines: [{
                            value: 2
                        }, {
                            value: 4,
                            class: 'grid4',
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
                    ]

                    //lines: [{value: 2}, {value: 4, class: 'grid4', text: 'LABEL 4'} ]
                },
                y: {
                    //show: true
                }
            },
            zoom: {
                enabled: true
            },

            {{--  regions: [{
                    start: 0,
                    end: 1
                },
                {
                    start: 2,
                    end: 4,
                    class: 'foo'
                }
            ]  --}}
        });

        {{--  setTimeout(function () {
                chart.load({
                    columns: [
                        ['data3', 400, 500, 450, 700, 600, 500]
                    ]
                });
            }, 1000);  --}}
    </script>

    <script>
        var chart = c3.generate({
            bindto: '#chart',
            data: {
                // x: 'x',
                //xFormat: '%Y%m%d', // 'xFormat' can be used as custom format of 'x'
                columns: [
                    // ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
                    // ['sample', 30, 200, 100, 400, 150, 250],
                    ['data1', 30, 200, 100, 400, 150, 250],
                    ['data2', 130, 340, 200, 500, 250, 350]
                ]
            },
            axis: {
                x: {
                    {{--  type: 'timeseries',
                        tick: {
                            format: '%Y-%m-%d'
                        },  --}}
                    label: { // ADD
                        text: 'x label',
                        position: 'middle'
                    }
                },
                y: {
                    label: { // ADD
                        text: 'Y Label',
                        position: 'outer-middle'
                    }
                }

            },
            grid: {
                x: {
                    lines: [{
                            value: 2
                        }, {
                            value: 4,
                            class: 'grid4',
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
                    ]

                    //lines: [{value: 2}, {value: 4, class: 'grid4', text: 'LABEL 4'} ]

                },
            },
            zoom: {
                enabled: false
            },

            regions: [{
                    start: 0,
                    end: 1
                },
                {
                    start: 2,
                    end: 4,
                    class: 'foo'
                }
            ]
        });


        {{--  setTimeout(function () {
                chart.load({
                    columns: [
                        ['data3', 400, 500, 450, 700, 600, 500]
                    ]
                });
            }, 1000);  --}}
    </script>
@endsection
