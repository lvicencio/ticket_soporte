@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Buscar</div>

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

                    <form action="" method="GET">
                       <!-- {{ csrf_field() }}-->

                       

                      <div class="form-group">
                        <label for="name">Buscar</label>
                         <input type="text" class="form-control" name="name" placeholder="Buscar Usuarios">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                      </div>
                    </form>

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Correo</th>
                          <th>Nombre</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->name }}</td>
                          <td>
                            <a href="usuario/{{ $user->id }}" class="btn btn-sm btn-primary" title="Editar">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="usuario/{{ $user->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar" onclick="
return confirm('¿Esta seguro de Eliminar este registro?')">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>


                </div>
            </div>

@endsection
