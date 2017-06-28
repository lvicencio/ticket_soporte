@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Discusión</h3>
                </div>

                <div class="panel-body">
                  @if (session('notification'))
                    <div class="alert alert-success">
                      {{ session('notification') }}
                    </div>
                  @endif

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Código</th>
                        <th>Proyecto</th>
                        <th>Categoría</th>
                        <th>Fecha de envío</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $incident->id }}</td>
                        <td>{{ $incident->proyect->name }}</td>
                        <td>{{ $incident->category_name }}</td>
                        <td>{{ $incident->created_at }}</td>
                      </tr>
                    </tbody>
                    <thead>
                      <tr>
                        <th>Asignado a</th>
                        <th>Nivel</th>
                        <th>Estado</th>
                        <th>Severidad</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $incident->support_name  }}</td>
                        <td>{{ $incident->level->name }}  </td>
                        <td>{{ $incident->state  }}</td>
                        <td>{{ $incident->severity_full  }}</td>
                      </tr>
                    </tbody>

                  </table>

                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th>Título</th>
                        <td>{{$incident->title }}</td>
                      </tr>
                      <tr>
                        <th>Descripción</th>
                        <td>{{$incident->description }}</td>
                      </tr>
                      <tr>
                        <th>Adjuntos</th>
                        <td></td>
                      </tr>
                    </tbody>

                  </table>

                  @if ($incident->support_id == NULL &&  $incident->active && auth()->user()->puedeTomar($incident))

                  <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary btn-sm" >
                    Atender
                  </a>
                  @endif

                  @if (auth()->user()->id == $incident->client_id)
                    @if ($incident->active)
                      <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm" type="button" name="button">
                        Terminar
                      </a>
                      <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-success btn-sm" type="button" name="button">
                        Editar
                      </a>
                    @else
                      <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-info btn-sm" type="button" name="button">
                        Abrir
                      </a>
                    @endif
                  @endif
            @if (auth()->user()->id == $incident->support_id && $incident->active)

                  <a href="/incidencia/{{ $incident->id }}/derivar" class="btn btn-danger btn-sm" type="button" name="button">
                    Pasar a Sgte Nivel
                  </a>
                  @endif

                </div>
            </div>
@include('layouts.chat')
@endsection
