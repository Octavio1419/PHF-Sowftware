@extends('layouts.app')
@section('contenido')
    <div class="row mt-1" style="width:100%; height:100%;">
        <div class="col-12 col-lg-6 col-xxl-4 d-flex">
            <div id="seleccionGraficas" class="card flex-fill w-100  h-100">
                <div class="card-body">
                    <h5 style='font-size: 30px; color:black;'><strong> Listado de datos </strong></h5>
                    <br>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01"> <strong> CIP </strong></label>
                        <select id="cip" class="form-select">
                            <option hidden selected>Selecciona una opción</option>
                            @foreach ($cips as $cip)
                                <option> {{ $cip['nombre'] }} </option>
                            @endforeach
                            <option>Todos</option>

                        </select>
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="col">
                            <label for="startDate"><strong>FECHA INICIO</strong></label>
                            <input id="startDate" class="form-control" type="date" max="<?php echo date('Y-m-d'); ?>" />
                        </div>
                        <div class="col">
                            <label for="endDate"><strong>FECHA FINAL</strong></label>
                            <input id="endDate" class="form-control" type="date" max="<?php echo date('Y-m-d'); ?>" />

                        </div>
                    </div>
                    <br>
                    {{--  <input type="text" id="datepicker">  --}}
                    <button id="btnconsultar"
                        class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Consultar
                        datos </button>
                </div>
            </div>
        </div>
        <div class="col-0 col-lg-6 col-xxl-8 d-flex ">
            <div id="seleccionGraficas" class="card">
                <div id="resultados" class="card-body" style="display:none;">
                    <h5 style='font-size: 30px; color:black;'><strong> Resultado de la búsqueda </strong></h5>
                    <br>

                    <div class="input-group mb-3">
                        <label class="btn btn-dark" for="inputGroupSelect01"> <strong> <i class="fa fa-search"></i> Filtrar
                                por
                                equipos
                            </strong></label>
                        <select id="buscar" name="buscar" class="form-select">
                            <option selected> Todos </option>

                        </select>
                    </div>

                    <div class="table-responsive">
                        <table id="unicatabla" class="table table-sortable" cellspacing="0"> {{--   table-striped table-hover  --}}
                            <thead class="table-secondary ">
                                <tr>
                                    {{--  style="visibility:collapse; display:none;"  --}}
                                    <th> lavados </th>
                                    <th id="f_inicial"> f_inicial </th>
                                    <th> f_final </th>
                                    <th> hora_inicial </th>
                                    <th> hora_final </th>
                                    <th> duracion </th>
                                    <th> cip </th>
                                    <th> tipo_cip </th>
                                    <th> equipo </th>
                                    <th> usuario </th>
                                    <th> Visualizar </th>

                                </tr>
                            </thead>
                            <tbody id="tablacontenido">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--  <script>
        $( function() {
            // An array of dates
            var eventDates = {};
            eventDates[ new Date( '08/07/2016' )] = new Date( '08/07/2016' );
            eventDates[ new Date( '08/12/2016' )] = new Date( '08/12/2016' );
            eventDates[ new Date( '08/18/2016' )] = new Date( '08/18/2016' );
            eventDates[ new Date( '08/23/2016' )] = new Date( '08/23/2016' );

            // datepicker
            $('#datepicker').datepicker({
                beforeShowDay: function( date ) {
                    var highlight = eventDates[date];
                    if( highlight ) {
                         return [true, "event", 'Tooltip text'];
                    } else {
                         return [true, '', ''];
                    }
                }
            });
        });
    </script>  --}}



    {{--  Script para el ordenamiento de la tabla con click sobre la columna  --}}
    <script>
        $('th').click(function() {
            console.log(this)

            var table = $(this).parents('table').eq(0)
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
            this.asc = !this.asc


            if (!this.asc) {
                rows = rows.reverse()
            }
            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i])
            }
            setIcon($(this), this.asc);

        })

        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index),
                    valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
            }
        }

        function getCellValue(row, index) {
            //console.log(index);
            return $(row).children('td').eq(index).html()
        }

        function setIcon(element, asc) {
            $("th").each(function(index) {
                $(this).removeClass("sorting");
                $(this).removeClass("asc");
                $(this).removeClass("desc");
            });
            element.addClass("sorting");
            if (asc) element.addClass("asc");
            else element.addClass("desc");
        }
    </script>

    <script>
        $("#btnconsultar").click(function(e) {
            e.preventDefault();

            $("#buscar").find('option').not(':first').remove();
            $("#buscar").val($("#buscar:first").val());

            var r_div = document.getElementById("resultados");
            var cip = document.getElementById("cip").value; //obteniendo el valor del cip seleccionado

            let f_inicio = (document.getElementById("startDate").value).split(
                "-"); //haciendo array para dividir la fecha  de inicio seleccionada
            let f_final = (document.getElementById("endDate").value).split(
                "-"); //haciendo array para dividir la fecha final seleccionada

            // Obteniendo dia, mes y año de fecha de inicio
            var f_inicio_dia = f_inicio[2];
            var f_inicio_mes = f_inicio[1];
            var f_inicio_anio = f_inicio[0];

            //Obteniendo dia, mes y año de fecha final
            var f_final_dia = f_final[2];
            var f_final_mes = f_final[1];
            var f_final_anio = f_final[0];

            var nom = "";

            if (cip == "Todos") {
                var cipTotal = document.getElementById("cip").length //Obteniendo la toda la lista de cip
                var cipTotal = cipTotal -
                    2; // En el select se tiene la opcion de "Seleccione un opcion" y la de "todos", por eso aqui se le resta 2

                var array = []; // Arreglo para obtener los valores del select que viene directo de la bd nom_cips
                /* For para iterar entre los valores que contiene el select */
                for (var i = 0; i < document.getElementById("cip").options.length - 1; i++) {
                    if (i > 0) { //Condicional para evitar el "Seleccione una opcion"
                        array.push(document.getElementById("cip").options[i].value);
                    }
                }

                var unCipConsulta =
                    "SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema' AND tablename between '" +
                    array[0] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia + "_cips' and '" +
                    array[0] +
                    "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia + "_cips'";

                switch (cipTotal) {
                    case 1:
                        nom = unCipConsulta;
                        break;
                    case 2:
                        nom = unCipConsulta + " or (tablename between '" +
                            array[1] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[1] +
                            "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia + "_cips');";
                        break;
                    case 3:
                        nom = unCipConsulta + " or (tablename between '" +
                            array[1] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[1] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips') or (tablename between '" +
                            array[2] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[2] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips');";
                        break;
                    case 4:
                        nom = unCipConsulta + " or (tablename between '" + array[1] + "_" + f_inicio_anio + "_" +
                            f_inicio_mes + "_" + f_inicio_dia + "_cips' and '" + array[1] + "_" + f_final_anio +
                            "_" + f_final_mes + "_" + f_final_dia + "_cips') or (tablename between '" +
                            array[2] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[2] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips') or (tablename between '" +
                            array[3] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[3] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips');";
                        break;
                    case 5:
                        nom = unCipConsulta + " or (tablename between '" + array[1] + "_" + f_inicio_anio + "_" +
                            f_inicio_mes + "_" + f_inicio_dia + "_cips' and '" + array[1] + "_" + f_final_anio +
                            "_" + f_final_mes + "_" + f_final_dia + "_cips') or (tablename between '" +
                            array[2] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[2] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips') or (tablename between '" +
                            array[3] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[3] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips') or (tablename between '" +
                            array[4] + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia +
                            "_cips' and '" + array[4] + "_" + f_final_anio + "_" + f_final_mes + "_" + f_final_dia +
                            "_cips');";
                        break;
                }
            } else {
                nom =
                    "SELECT * FROM pg_catalog.pg_tables WHERE schemaname != 'pg_catalog' AND schemaname != 'information_schema' AND tablename between '" +
                    cip + "_" + f_inicio_anio + "_" + f_inicio_mes + "_" + f_inicio_dia + "_cips' and '" + cip +
                    "_" +
                    f_final_anio + "_" + f_final_mes + "_" + f_final_dia + "_cips';";
            }


            //console.log(nom);


            // let datos = { nombre:cip, fecha_inicial:f_inicio,  fecha_final:f_final };

            fetch('/buscar/' + nom)
                .then(response => response.json())
                .then(respuesta => {

                    //console.log(JSON.stringify(respuesta));
                    tabla(respuesta);
                    r_div.style.display = "block";
                    ordenar();

                });

        });

        function tabla(respuesta) {
            const buscador = [];
            tablacontenido.innerHTML = ''
            for (let valor of respuesta) {
                for (let i = 0; i < valor.length; i++) {
                    //console.log(valor[i]);

                    //console.log(valor[i].tipo_cip +"-"+valor[i].hora_inicial);
                    tablacontenido.innerHTML += `
                    <tr style='font-size: 12px' >
                        <td class="text-center"> ${ valor[i].idlavados } </td>
                        <td class="text-center"> ${ valor[i].f_inicial } </td>
                        <td class="text-center"> ${ valor[i].f_final } </td>
                        <td class="text-center"> ${ valor[i].hora_inicial } </td>
                        <td class="text-center"> ${ valor[i].hora_final } </td>
                        <td class="text-center"> ${ valor[i].duracion } </td>
                        <td class="text-center"> ${ valor[i].cip } </td>
                        <td class="text-center"> ${ valor[i].tipo_cip }  </td>
                        <td class="text-center"> ${ valor[i].equipo } </td>
                        <td class="text-center"> ${ valor[i].usuario } </td>


                        <td class="text-center"><button class="btn btn-outline-success" > <i id="graficar" class="fa-solid fa-chart-line fa-xl"></i> </button></td>
                    </tr>
                `;

                    buscador.push("" + valor[i].equipo);

                }
            }

            const unicos = buscador.filter((valor, indice) => {
                return buscador.indexOf(valor) === indice;
            });
            unicos.sort();

            var select = document.getElementsByName("buscar")[0];
            for (value in unicos) {
                var option = document.createElement("option");
                option.text = unicos[value];
                select.add(option);
            }


        }

        $('#tablacontenido').on('click', '#graficar', (e) => {
            var td = event.target.parentNode;
            var tr = td.parentNode;
            //tr.parentNode.children[1].textContent

            {{--  var filaseleccionada = {'idlavados': tr.parentNode.children[0].textContent,
                                    'cip': tr.parentNode.children[1].textContent,
                                    'f_inicial': tr.parentNode.children[5].textContent,
                                    'equipo': tr.parentNode.children[4].textContent };  --}}

            var filaseleccionada = tr.parentNode.children[0].textContent + "=" + tr.parentNode.children[6]
                .textContent + "=" + tr.parentNode.children[1].textContent + "=" + tr.parentNode.children[8]
                .textContent;

            //console.log(filaseleccionada);

            window.location = '/graficas/' + filaseleccionada;


        });

        function ordenar() {
            $(function() {
                var index = 1,
                    rows = [],
                    thClass = $(this).hasClass('asc') ? 'desc' : 'asc';
                console.log(index);
                $('#unicatabla th').removeClass('asc desc');
                $(this).addClass(thClass);
                $('#unicatabla tbody tr').each(function(index, row) {
                    rows.push($(row).detach());
                });
                rows.sort(function(a, b) {
                    var aValue = $(a).find('td').eq(index).text(),
                        bValue = $(b).find('td').eq(index).text();
                    return aValue > bValue ?
                        1 :
                        aValue < bValue ?
                        -1 :
                        0;
                });
                if ($(this).hasClass('desc')) {
                    rows.reverse();
                }
                $.each(rows, function(index, row) {
                    $('#unicatabla tbody').append(row);
                });

            });
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    {{--  filtrando por equipos mediante la lista que se despliega del select  --}}
    <script>
        $("#buscar").change(function() {
            if (this.value != "") // Solo modifique esta linea
            {
                //split the current value of searchInput
                var data = this.value.split(" ");
                //create a jquery object of the rows
                var jo = $("#tablacontenido").find("tr");

                if (this.value == "" || this.value == "Todos") {

                    jo.show();
                    return;
                }

                //hide all the rows
                jo.hide();

                //Recusively filter the jquery object to get results.
                jo.filter(function(i, v) {
                        var $t = $(this);
                        for (var d = 0; d < data.length; ++d) {
                            if ($t.is(":contains('" + data[d] + "')")) {
                                return true;
                            }
                        }
                        return false;
                    })
                    //show the rows that match.
                    .show();
            }
        }).focus(function() {
            this.value = "";
            $(this).css({
                "color": "black"
            });
            $(this).unbind('focus');
        }).css({
            "color": "#C0C0C0"
        });
    </script>
@endsection
