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
                <form method="POST" action="{{ route('service.update',[$service]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ $service->name }}">
                    </div>
                    <div class="form-group">
                      <label for="description">Descripción</label>
                      <textarea class="form-control" id="description" name="description" rows="3"  >{{ $service->description }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="price">Precio</label>
                      <input type="text" class="form-control" id="price" name="price" placeholder="Titulo" value="{{ $service->price }}">
                    </div>
                    <div class="form-group">
                      <label for="location">Ubicación</label>
                      <input type="text" class="form-control" id="location" name="location" placeholder="Titulo" value="{{ $service->location }}">
                    </div>
                    <div class="form-group">
                      <label for="type">Tipo de Servicio</label>
                      <select class="form-control" id="type" name="type">
                        @foreach ($typeServices as $type)
                        @if ($service->type->name == $type->name)
                        <option selected>{{$type->name}}</option>
                        @else
                        <option>{{$type->name}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="teacher">Encargado</label>
                      <input type="text" class="form-control" id="teacher" name="teacher" placeholder="Titulo" value="{{ $service->teacher }}">
                    </div>
                    <div class="form-group">
                      <label for="image">Imagen</label>
                      <input type="file" class="form-control-file" id="image" name="image" value="  {{ $service->image }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection