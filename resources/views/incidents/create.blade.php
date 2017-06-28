@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Reportes</div>

                <div class="panel-body">
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
                        <label for="category_id">Categoria</label>
                        <select class="form-control" name="category_id">
                          <option value="">General</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="severity">Severidad</label>
                        <select class="form-control" name="severity">
                          <option value="M">Menor</option>
                          <option value="N">Normal</option>
                          <option value="A">Alta</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="title">Titulo</label>
                         <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                      </div>
                      <div class="form-group">
                        <label for="description">Descripción</label>
                          <textarea name="description" class="form-control" >{{ old('description') }}</textarea>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Registrar Incidencia</button>
                      </div>
                    </form>


                </div>
            </div>

@endsection
