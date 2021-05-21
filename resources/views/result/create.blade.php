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
                <form method="POST" action="{{ route("result.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="calendar">Numero de Jornada (Agregar ultima jornada aca)</label>
                      <input type="text" class="form-control" id="calendar" name="calendar" placeholder="Ingrese Jornada" value="{{old('calendar')}}">
                    </div>
                    <div class="form-group">
                      <label for="date">Fecha de Jornada</label>
                      <input type="date" class="form-control" id="date" name="date" placeholder="Ingrese numero de cédula" value="{{old('date')}}">
                    </div>
                    <div class="form-group">
                      <label for="horary">Horario</label>
                      <input type="time" class="form-control" id="horary" name="horary" placeholder="Ingrese Apellido" value="{{old('horary')}} " min="11:00" max="16:00" step="3600">
                    </div>
                    <div>
                      <div class="form-group" style="float:left; width: 45%;">
                        <label for="team_id_a">Equipo A</label>
                        <select class="form-control" id="team_id_a" name="team_id_a" value="{{old('team_id_a')}}" >
                          @foreach ($teams as $team)
                            <option>{{$team->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group" style="float:right; width: 45%;">
                        <label for="team_id_b">Equipo B</label>
                        <select class="form-control" id="team_id_b" name="team_id_b" value="{{old('team_id_b')}}" >
                          @foreach ($teams as $team)
                            <option>{{$team->name}}</option>
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