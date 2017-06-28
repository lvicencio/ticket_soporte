@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Crear Proyecto</div>

                <div class="panel-body">
                  <!-- Mensage de session notification -->
                  @if (session('notification') )
                    <div class="alert alert-success">
                      {{ session('notification') }}
                    </div>
                  @endif
                  <!-- Errores de validaciones -->
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>

                  @endif

                    <form action="" method="POST">
                       {{ csrf_field() }}

                      <div class="form-group">
                        <label for="name">Nombre</label>
                         <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                      </div>
                      <div class="form-group">
                        <label for="description">Descripción</label>
                         <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                      </div>
                      <div class="form-group">
                        <label for="start">Fecha de Inicio (dd/mm/aaaa)</label>
                         <input type="date" class="form-control" name="start" value="{{ old('start',date('Y-m-d')) }}">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Registrar Proyecto</button>
                      </div>
                    </form>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Descripción</th>
                          <th>Fecha de Inicio</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($projects as $project)
                        <tr>
                          <td>{{ $project->name }}</td>
                          <td>{{ $project->description }}</td>
                          <td>{{ $project->start ?: 'No Indicado' }}</td>
                          <td>

                            @if ($project->trashed())
                              <a  class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-alert"></span></a>


                              <a href="proyecto/{{ $project->id }}/restaurar" class="btn btn-sm btn-success" title="Restaurar" onclick="
  return confirm('¿Habilitar este Proyecto?')">
                                <span class="glyphicon glyphicon-repeat"></span>
                              </a>

                            @else
                              <a href="proyecto/{{ $project->id }}" class="btn btn-sm btn-primary" title="Editar">
                                <span class="glyphicon glyphicon-pencil"></span>
                              </a>
                            <a href="proyecto/{{ $project->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar" onclick="
return confirm('¿Esta seguro de Deshabilitar este Proyecto?')">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>


                </div>
            </div>

@endsection
