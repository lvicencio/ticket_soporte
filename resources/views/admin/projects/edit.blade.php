@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Editar Proyecto</div>

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
                       <input type="text" class="form-control" name="name" value="{{ old('name', $project->name) }}">
                    </div>
                    <div class="form-group">
                      <label for="description">Descripción</label>
                       <input type="text" class="form-control" name="description" value="{{ old('description',$project->description) }}">
                    </div>
                    <div class="form-group">
                      <label for="start">Fecha de Inicio (dd/mm/aaaa)</label>
                       <input type="date" class="form-control" name="start" value="{{ old('start',$project->start) }}">
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
                    </div>
                  </form>

                  <div class="row">
                    <div class="col-md-6">
                      <p>Categorias</p>
                      <form class="form-inline" action="/categorias" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="proyect_id" value="{{ $project->id }}">
                          <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre">
                          </div>

                            <button class="btn btn-primary" >Añadir</button>

                      </form>
                      <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Proyecto</th>
                              <th>Opciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($categories as $category)

                            <tr>
                              <td> {{ $category->name }}</td>
                              <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-category="{{ $category->id}}">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <a href="/categoria/{{ $category->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar" onclick="
    return confirm('¿Esta seguro de Deshabilitar este Proyecto?')">
                                  <span class="glyphicon glyphicon-trash"></span>
                                </a>
                              </td>
                            </tr>

                            @endforeach
                          </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                      <p>Niveles</p>
                      <form class="form-inline" action="/niveles" method="POST">
                        {{ csrf_field() }}
                          <input type="hidden" name="proyect_id" value="{{ $project->id }}">
                          <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Ingrese Nombre">
                          </div>

                            <button class="btn btn-primary" >Añadir</button>

                      </form>
                      <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Nivel</th>
                              <th>Opciones</th>
                            </tr>
                          </thead>
                          <tbody>

                            <!-- key = posicion--->
                            @foreach ($levels as $key=> $level)

                            <tr>
                              <td>N{{ $key + 1 }}</td>
                              <td> {{ $level->name }}</td>
                              <td>
                                <button type="button" class="btn btn-sm btn-primary" title="Editar" data-level="{{ $level->id}}">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <a href="/nivel/{{ $level->id }}/eliminar" class="btn btn-sm btn-danger" title="Eliminar" onclick="
    return confirm('¿Esta seguro de Deshabilitar este Proyecto?')">
                                  <span class="glyphicon glyphicon-trash"></span>
                                </a>
                              </td>
                            </tr>

                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>




                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="modalEditCategory">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Categoria</h4>
                  </div>

                  <form class="" action="/categoria/editar" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <input type="hidden" name="category_id" id="category_id" value="">
                          <div class="form-group">
                            <label for="name">Nombre de Categoria</label>
                            <input type="text" class="form-control" name="name" id="category_name" value="">
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <div class="modal fade" tabindex="-1" role="dialog" id="modalEditLevel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Nivel</h4>
                  </div>

                  <form class="" action="/nivel/editar" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <input type="hidden" name="level_id" id="level_id" value="">
                          <div class="form-group">
                            <label for="name">Nombre de Nivel</label>
                            <input type="text" class="form-control" name="name" id="level_name" value="">
                          </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
@endsection

@section('scripts')
    <script src="/js/admin/projects/edit.js"></script>
@endsection
