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
                <form method="POST" action="{{ route("team.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                      <label for="color">Color</label>
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
@endsection