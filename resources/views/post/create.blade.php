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
                <form method="POST" action="{{ route("post.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titulo" value="{{old('title')}}">
                      </div>
                    <div class="form-group">
                        <label for="content">Contenido</label>
                        <textarea class="form-control" id="content" name="content" rows="3">{{old('content')}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="inputFile">Imagen</label>
                        <input type="file" class="form-control-file" id="inputFile" name="inputFile">
                      </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
@endsection