<div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Discusión</h3>
    </div>
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

      <ul class="media-list">
        
        @foreach ($messages as $message)


        <li class="media">
          <div class="media-body">
            <a class="pull-left" href="#">
              <img class="media-object img-circle" src="{{ $message->user->avatar_foto }}" width="48"   alt="">
            </a>
            <div class="media-body">
               {{ $message->message}}
              <br>
              <small class="text-muted">{{ $message->user->name }} | {{ $message->created_at}}</small>
              <hr>
            </div>

          </div>

        </li>
        @endforeach
      </ul>

    </div>

    <div class="panel-footer">
      <form action="/mensajes" method="post">
        <input type="hidden" name="incident_id" value="{{ $incident->id }}">
        {{ csrf_field() }}
          <div class="input-group">
            <input type="text" class="form-control" name="message">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit" >Enviar</button>
            </span>
          </div>
      </form>
    </div>

</div>
