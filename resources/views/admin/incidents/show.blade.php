 @extends('layouts.app')

@section('content')
 
 <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Lista de Tickets</h3>
                </div>

    <div class="panel-body">
                  @if (session('notification'))
                    <div class="alert alert-success">
                      {{ session('notification') }}
                    </div>
                  @endif

                  <div class="panel-body">


                    <form action="" method="GET">
                      <div class="form-group">
                        <label for="name">Buscar</label>
                         <input type="text" class="form-control" name="name" placeholder="Buscar Tickets">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                      </div>
                    </form>


            <table class="table table-bordered" >
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
              <tbody id="dashboard_mis_incidencias" >

                  @foreach ($incidents as $incident)
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
                          <a href="/ver/{{ $incident->id }}"> 
                            <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true">  Ver </span></button>
                            
                          </a>

                      </td>
                    </tr>
                  @endforeach

              </tbody>
            </table>
          </div>

                
            

     </div>
</div>

@endsection