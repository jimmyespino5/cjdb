@extends('base')
@section('css_page')
  <link rel="stylesheet" type="text/css" href="{{asset('css/showservices.css')}}">
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-6 " >
                    <img src="{{asset($service->image)}}" class="card-img" alt="..."></img> 
                  </div>
                  <div class="col-md-6 "> 
                    <div class="card-body">
                      <p class="card-title titulo">{{ $service->name }}</p>
                      <p class="card-text"><span class="titulos">Descripción:</span> {{ $service->description}}</p>
                      <p class="card-text"><span class="titulos">Precio:</span> {{ $service->price}}Bs</p>
                      <p class="card-text"><span class="titulos">Ubicación:</span> {{ $service->location}}</p>
                      <p class="card-text"><span class="titulos">Profesor(a):</span> {{ $service->teacher}}</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection