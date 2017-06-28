@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Crear Usuario de Soporte</div>

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
                        <label for="email">Correo Electronico</label>
                         <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                      </div>
                      <div class="form-group">
                        <label for="name">Nombre</label>
                         <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                      </div>
                      <div class="form-group">
                        <label for="password">Contraseña</label>
                         <input type="text" class="form-control" name="password" value="{{ old('password',str_random(6)) }}">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
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
