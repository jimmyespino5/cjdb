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
    @if($user->role == 1)
      <div class="content" id="formulario">
          <div class="row">
              <div class="col-2">
              </div>
              <div class="col-8" >
                  <form method="POST" action="{{ route("team.store") }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{old('name')}}">
                      </div>
                      <div class="form-group">
                        <label for="color">Coloraaaa</label>
                        <input type="text" class="form-control" id="color" name="color" placeholder="Color" value="{{old('color')}}">
                      </div>
                      <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                      </div>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
              </div>
              <div class="col-2">
              </div>
          </div>
      </div>
    @elseif ($user->role == 4)
      <!-- Futbol-->
      <div class="content" id="formulario">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8" >
                <form method="POST" action="{{ route("team.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                      <label for="type">Equipo</label>
                      <select class="form-control" id="type" name="type">
                        @foreach ($teams as $team)
                          <option>{{$team->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

                <table>
                  <tr>
                    <td> 
                      <ul>
                        @foreach ($teamsA as $team)
                          <li>{{$team->name}}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>
                      <ul>
                        @foreach ($teamsB as $team)
                          <li>{{$team->name}}</li>
                        @endforeach
                      </ul>
                    </td>
                  </tr>
                </table>

            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
    @elseif ($user->role == 5)
      <!-- Futsal-->
      <div class="content" id="formulario">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8" >
                <form method="POST" action="{{ route("position.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <input type="hidden" name="sport" value="{{$user->role}}">
                    </div>
                    <div class="form-group">
                      <label for="group">Grupo</label>
                      <select class="form-control" id="group" name="group">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="team">Equipo</label>
                      <select class="form-control" id="team" name="team">
                        @foreach ($teams->get() as $team)
                          <option>{{$team->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
                
                <table class="table table-bordered ">
                  @php $count = 1
                  @endphp
                  <tr>
                    @while ($count <= $groups)
                    <td class="align-text-top"> 
                      <p class="h3"> Grupo {{$count}} </p>
                    </td>
                    @php $count+=1
                    @endphp
                    @endwhile
                  </tr>
                  @php $count = 1
                  @endphp
                  <tr>
                    @while ($count <= $groups)
                    <td class="align-text-top"> 
                      <ul>
                        @foreach ($teamsGroup as $teamg)
                          @if($teamg->group == $count)
                            <li>{{$teamg->team->name}} {{$teamg->group}}</li>
                          @endif
                        @endforeach
                      </ul>
                    </td>
                    @php $count+=1
                    @endphp
                    @endwhile
                  </tr>

                </table>

            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
    @endif
@endsection