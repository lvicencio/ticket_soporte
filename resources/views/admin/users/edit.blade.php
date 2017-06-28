@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Editar Usuario</div>

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
                         <input type="email" class="form-control" name="email"  value="{{ old('email', $user->email) }}">
                          <!--  <input type="email" class="form-control" name="email" readonly value="{{ old('email') }}"> -->
                      </div>
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name ) }}">

                      </div>
                      <div class="form-group">
                        <label for="severity">Role Actual</label>
                        <select class="form-control" name="role">
                          <option value="0" @if ($user->role == '0')
                            selected
                          @endif>administrador</option>
                          <option value="1" @if ($user->role == '1')
                            selected
                          @endif>Soporte</option>
                          <option value="2" @if ($user->role == '2')
                            selected
                          @endif>Cliente</option>
                        </select>
                      </div>

                     <div class="form-group">
                        <label for="password">Contraseña <em>(Ingresar solo si se desea cambiar)</em></label>
                         <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Editar Usuario</button>
                      </div>
                    </form>

                    <form action="/proyecto-usuario" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" name="proyect_id" id="select-project">
                          <option value="">Seleccione Proyecto</option>
                          @foreach ($projects as $project)
                            <option value="{{ $project->id }}"> {{$project->name}} </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select class="form-control" name="level_id" id="select-level">
                          <option value="">Seleccione Nivel</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" name="button" class="btn btn-primary btn-block">Asignar Proyecto</button>
                      </div>
                    </div>
                    </form>


                      <tr>Proyectos Asignados</tr>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Proyecto</th>
                          <th>Nivel</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($proyects_user as $proyect_user)

                        <tr>
                          <td>{{ $proyect_user->proyect->name }}</td>
                          <td>{{ $proyect_user->level->name }}</td>
                          <td>
                            <a href="#" class="btn btn-sm btn-primary" title="Editar">
                              <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="/proyecto-usuario/{{ $proyect_user->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">
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

@section('scripts')
  <script src="/js/admin/users/edit.js">

  </script>
@endsection
