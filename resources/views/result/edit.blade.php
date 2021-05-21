@extends('base')
@section('content')
  @if(Session::has('message'))
  <div class="container alert alert-success">
    {{Session::get('message')}}
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li> {{ $error }}    
      @endforeach
    </ul>
  </div>
  @endif
  <div class="content" id="formulario">
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8" >
            <form method="POST" action="{{ route("result.update",[$result]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="calendar">Numero de Jornada (Agregar ultima jornada aca)</label>
                  <input type="text" class="form-control" id="calendar" name="calendar" placeholder="Ingrese Jornada" value="{{$result->calendar}}">
                </div>
                <div class="form-group">
                  <label for="date">Fecha de Jornada</label>
                  <input type="date" class="form-control" id="date" name="date" placeholder="Ingrese numero de cédula" value="{{$result->date}}">
                </div>
                <div class="form-group">
                  <label for="horary">Horario</label>
                  <input type="time" class="form-control" id="horary" name="horary" placeholder="Ingrese Apellido" value="{{$result->horary}}.00" min="11:00" max="16:00" step="3600">
                </div>
                <div>
                  <div class="form-group" style="float:left; width: 45%;">
                    <label for="team_id_a">Equipo A</label>
                    <select class="form-control" id="team_id_a" name="team_id_a" value="{{$result->team_id_a}}" >
                      @foreach ($teams as $team)
                      @if ($team->id == $result->team_id_a)
                      <option selected>{{$team->name}}</option>
                      @else
                      <option>{{$team->name}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" style="float:right; width: 45%;">
                    <label for="team_id_b">Equipo B</label>
                    <select class="form-control" id="team_id_b" name="team_id_b" value="{{$result->team_id_b}}" >
                      @foreach ($teams as $team)
                        @if ($team->id == $result->team_id_b)
                        <option selected>{{$team->name}}</option>
                        @else
                        <option>{{$team->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>         
                <div style="clear:both;">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>           
            </form>
        </div>
        <div class="col-2">
        </div>
    </div>
  </div>
@endsection