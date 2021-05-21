@extends('base')
@section('content')
    @if (!$teams->isEmpty())
            <div class="container-fluid container_secundario">
                <div class="row ">
                    @foreach ($teams as $team)
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{$team->logo}}" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">{{$team->name}}</h5>
                          <p class="card-text">{{$team->color}}</p>
                          <a href="{{ route('team.show',$team) }}" class="btn btn-primary">Ver mas</a>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
    @else
        <h2>No hay servicios</h2>
    @endif

@endsection