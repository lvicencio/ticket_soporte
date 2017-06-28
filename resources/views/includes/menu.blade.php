<div class="panel panel-primary">
  <div class="panel-heading">Menú</div>
  <div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
      @if (auth()->check())
            <li @if (request()->is('home')) class="active" @endif><a href="/home">Dashboard</a></li>
                @if (! auth()->user()->is_client)
                  <li @if (request()->is('ver')) class="active" @endif><a href="/ver">Ver Incidencias</a></li>
                @endif
                  <li @if (request()->is('reportar')) class="active" @endif><a href="/reportar">Reportar Incidencia</a></li>
                @if (auth()->user()->is_admin)
                  <li role="presentation" class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Administración <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="/usuarios">Usuarios</a></li>
                    <li><a href="/proyectos">Proyectos</a></li>
                    <li><a href="/configusuarios">Configuración Usuarios</a></li>
                  </ul>
                </li>
              @endif
      @else
        <li><a href="#">Bienvenido</a></li>
        <li><a href="#">Instrucciones</a></li>
        <li><a href="#">Créditos</a></li>
      @endif

    </ul>
  </div>
</div>
