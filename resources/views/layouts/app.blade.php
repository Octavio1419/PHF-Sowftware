<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title> PHF SOFTWARE </title>

    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    {{--  Importando js de C3 para las graficas y Ajax para la consulta de la tabla index  --}}
    <script src="{{ URL::asset('js/c3.js') }}"></script>
    <script src="{{ URL::asset('js/d3-v5-min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/app.js') }}"></script>
    <script src="{{ URL::asset('js/ajax.js') }}"></script>
    <script src="{{ URL::asset('js/all.js') }}"></script>
    <script src="{{ asset('js/edit.js') }}"></script>

    {{--  -----------------------------------------------------------------------  --}}


</head>

<body>

    <body>

        <div class="wrapper">
            <nav id="sidebar" class="sidebar js-sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="index.html">
                        <span class="align-middle">PHF SOFTWARE</span>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Principal
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/graficas">
                                <i class="fa fa-area-chart"></i> <span class="align-middle">JARABE
                                    TERMINADO</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="">
                                <i class="fa fa-area-chart"></i> <span class="align-middle">CLARIFICADO</span>
                            </a>
                        </li>



                        {{--  <li class="sidebar-header">
                            Tools & Components
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-buttons.html">
                                <i class="align-middle" data-feather="square"></i> <span
                                    class="align-middle">Buttons</span>
                            </a>
                        </li>  --}}
                        {{--
                        MENU PARA EL USUARIO ADMINISTRADOR --}}
                        @can('EsAdmin')
                            <li class="sidebar-header">
                                Administrador
                            </li>
                            </li>

                            <!-- Default dropend button -->

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="admin">
                                    <i class="fa fa-area-chart"></i> <span class="align-middle">
                                        CIPS 1 </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/graficas">
                                    <i class="fa fa-area-chart"></i> <span class="align-middle">
                                        CIPS 2 </span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/graficas">
                                    <i class="fa fa-area-chart"></i> <span class="align-middle">
                                        Etiquetas </span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/graficas">
                                    <i class="fa fa-area-chart"></i> <span class="align-middle">
                                        Marcas </span>
                                </a>
                            </li>

                            <li class="sidebar-header">
                                Otros
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="">
                                    <i class="bi bi-person-fill-gear"></i> <span class="align-middle">Administrativo</span>
                                </a>
                            </li>
                        @endcan

                    </ul>

                </div>
            </nav>

            <div class="main">
                @include('partial.nav')

                @yield('contenido')

            </div>


        </div>
    </body>
</body>

</html>
