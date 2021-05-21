@extends('base')
@section('content')
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
                <form method="POST" action="{{ route("player.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="id">Cédula</label>
                      <input type="text" class="form-control" id="id" name="id" placeholder="Ingrese numero de cédula" value="{{old('id')}}">
                    </div>
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese Nombre" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                      <label for="lastname">Apellido</label>
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ingrese Apellido" value="{{old('lastname')}}">
                    </div>
                    <div class="form-group">
                      <label for="number">Dorsal</label>
                      <input type="text" class="form-control" id="number" name="number" placeholder="Ingrese dorsal" value="{{old('number')}}">
                    </div>
                    <div class="form-group">
                      <label for="birthday">Birthday:</label>
                      <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Ingrese Fecha de nacimiento" value="{{old('birthday')}}">
                    </div>
                    <div class="form-group">
                      <label for="age">Edad</label>
                      <input type="text" class="form-control" id="age" name="age" placeholder="Ingrese edad" value="{{old('age')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection