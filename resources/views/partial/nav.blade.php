<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">

                @can('EsAdmin')
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i>  {{ Auth::user()->nombre }}
                    </a>
                @endcan

                @can('EsCliente')
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <i class="fa fa-industry" aria-hidden="true"> </i> {{ Auth::user()->nombre }}
                    </a>
                @endcan

                <div class="dropdown-menu dropdown-menu-end">

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"href="{{ route('salir') }}">Cerrar Sesion</a>

                </div>
            </li>
        </ul>
    </div>
</nav>
