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
                <form method="POST" action="{{ route('team.update',[$team]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ $team->name }}">
                    </div>
                    <div class="form-group">
                      <label for="color">Descripción</label>
                      <textarea class="form-control" id="color" name="color" rows="3"  >{{ $team->color }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="logo">Logo</label>
                      <input type="file" class="form-control-file" id="logo" name="logo" value="  {{ $team->logo }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection