@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
  <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
     @if (auth()->user()->is_support)


      <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Mis Ticket (asignados a mí persona)</h3>
          </div>
        <div class="panel-body">
            <table class="table table-bordered" >
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>
                </tr>
              </thead>
              <tbody id="dashboard_mis_incidencias" >

                  @foreach ($my_incidents as $incident)
                    <tr>
                      <td>
                          <a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a>

                      </td>
                      <td>{{ $incident->category_name  }}</td>
                      <td>{{ $incident->severity_full }}</td>
                      <td>{{ $incident->state }}</td>
                      <td>{{ $incident->created_at }}</td>
                      <td>{{ $incident->title_resumen }}</td>
                    </tr>
                  @endforeach

              </tbody>
            </table>
          </div>
        </div>

        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">  Ticket sin asignar </h3>
          </div>

          <div class="panel-body">
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Categoría</th>
                  <th>Severidad</th>
                  <th>Estado</th>
                  <th>Fecha Creación</th>
                  <th>Título</th>
                  <th>Opción</th>
                </tr>
              </thead>
              <tbody id="dashboard_incident_pendientes">
                @foreach ($incident_pendientes as $incident)
                  <tr>
                    <td>
                        <a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a>

                    </td>
                    <td>{{ $incident->category_name  }}</td>
                    <td>{{ $incident->severity_full }}</td>
                    <td>{{ $incident->state }}</td>
                    <td>{{ $incident->created_at }}</td>
                    <td>{{ $incident->title_resumen }}</td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm">
                        Atender
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

     @endif

          <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title"> Ticket creados por mí</h3>
              </div>

              <div class="panel-body">
                  <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Severidad</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>
                    <th>Título</th>
                    <th>Responsable</th>
                  </tr>
                </thead>
                <tbody id="dashboard_de_mi">
                  @foreach ($mis_incidencias as $incident)
                    <tr>
                      <td>
                          <a href="/ver/{{ $incident->id }}">{{ $incident->id }}</a>

                      </td>
                      <td>{{ $incident->category_name }}</td>
                      <td>{{ $incident->severity_full }}</td>
                      <td>{{ $incident->state }}</td>
                      <td>{{ $incident->created_at }}</td>
                      <td>{{ $incident->title_resumen }}</td>
                      <td>{{ $incident->support_id  ?: 'Sin Asignar'}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            </div>

      </div>
    </div>
</div>

@endsection
