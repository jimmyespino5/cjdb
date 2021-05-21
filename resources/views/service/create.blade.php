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
                <form method="POST" action="{{ route("service.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                      <label for="description">Descripcion</label>
                      <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="price">Precio</label>
                      <input type="text" class="form-control" id="price" name="price" placeholder="Precio" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                      <label for="location">Ubicación</label>
                      <input type="text" class="form-control" id="location" name="location" placeholder="Ubicación" value="{{old('location')}}">
                    </div>
                    <div class="form-group">
                      <label for="type">Tipo de Servicio</label>
                      <select class="form-control" id="type" name="type">
                        @foreach ($typeServices as $type)
                          <option>{{$type->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="teacher">Encargado</label>
                      <input type="text" class="form-control" id="teacher" name="teacher" placeholder="Ubicación" value="{{old('teacher')}}">
                    </div>
                    <div class="form-group">
                      <label for="image">Imagen</label>
                      <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection