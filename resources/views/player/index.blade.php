@extends('base')
@section('content')
    @if (!$players->isEmpty())
            <div class="container-fluid container_secundario">
                <div class="row ">
                    @foreach ($players as $player)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">{{$player->name}}</h5>
                          <h5 class="card-text">{{$player->lastname}}</h5>
                          <p class="card-text">Numero: {{$player->number}}</p>
                          <a href="{{ route('player.show',$player) }}" class="btn btn-primary">Ver mas</a>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
    @else
        <h2>No hay servicios</h2>
    @endif

@endsection