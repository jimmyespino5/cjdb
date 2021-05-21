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
            <form method="POST" action="{{ route("result.updateResult",[$result]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="calendar">Numero de Jornada (Agregar ultima jornada aca)</label>
                  <input type="text" class="form-control" id="calendar" name="calendar" placeholder="Ingrese Jornada" value="{{$result->calendar}}" disabled>
                </div>
                <div class="form-group">
                  <label for="date">Fecha de Jornada</label>
                  <input type="date" class="form-control" id="date" name="date" placeholder="Ingrese numero de cédula" value="{{$result->date}}" disabled>
                </div>
                <div class="form-group">
                  <label for="horary">Horario</label>
                  <input type="time" class="form-control" id="horary" name="horary" placeholder="Ingrese Apellido" value="{{$result->horary}}.00" min="11:00" max="16:00" step="3600" disabled>
                </div>
                <div>
                  <div class="form-group" style="float:left; width: 45%;">
                    <label for="team_id_a">Equipo A</label>
                    <select class="form-control" id="team_id_a" name="team_id_a" value="{{$result->team_id_a}}" disabled>
                      @foreach ($teams as $team)
                      @if ($team->id == $result->team_id_a)
                      <option selected>{{$team->name}}</option>
                      @else
                      <option>{{$team->name}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  <input type="text" name="team_a_envio" id = "team_a_envio" style="display:none;" value="{{$result->team_id_a}}">
                  <div class="form-group" style="float:right; width: 45%;">
                    <label for="team_id_b">Equipo B</label>
                    <select class="form-control" id="team_id_b" name="team_id_b" value="{{$result->team_id_b}}" disabled>
                      @foreach ($teams as $team)
                        @if ($team->id == $result->team_id_b)
                        <option selected>{{$team->name}}</option>
                        @else
                        <option>{{$team->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <input type="text" name="team_b_envio" id = "team_b_envio" style="display:none;" value="{{$result->team_id_b}}">
                </div>         
                <div>
                  <div class="form-group" style="float:left; width: 45%;">
                    <label for="team_id_a">Goles equipo A</label>
                    <input type="text" class="form-control" id="gols_a" name="gols_a" placeholder="Ingrese Jornada" value="{{$result->gols_a}}">
                  </div>
                  <input type="text" name="old_gols_a" id = "old_gols_a" style="display:none;" value="{{$result->gols_a}}">
                  <div class="form-group" style="float:right; width: 45%;">
                    <label for="team_id_b">Goles equipo B</label>
                    <input type="text" class="form-control" id="gols_b" name="gols_b" placeholder="Ingrese Jornada" value="{{$result->gols_b}}">
                  </div>
                  <input type="text" name="old_gols_b" id = "old_gols_b" style="display:none;" value="{{$result->gols_b}}">
                </div>  
                <div>
                  <div class="form-group" style="float:left; width: 45%;">
                    <label for="team_id_a">Goleadores equipo A</label>
                    <input type="text" class="form-control" id="scorers_a" name="scorers_a" placeholder="Ingrese Jornada" value="{{$result->scorers_a}}">
                  </div>
                  <input type="text" name="old_scorers_a" id = "old_scorers_a" style="display:none;" value="{{$result->scorers_a}}">
                  <div class="form-group" style="float:right; width: 45%;">
                    <label for="team_id_b">Goleadores equipo B</label>
                    <input type="text" class="form-control" id="scorers_b" name="scorers_b" placeholder="Ingrese Jornada" value="{{$result->scorers_b}}">
                  </div>
                  <input type="text" name="old_scorers_b" id = "old_scorers_b" style="display:none;" value="{{$result->scorers_b}}">
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