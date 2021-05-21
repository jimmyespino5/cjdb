@extends('base')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-9">
                    <div class="card-body">
                      <p class="card-title titulo">{{ $player->name }} {{ $player->lastname }}</p>
                      <p class="card-text">Fecha de Nacimiento: {{ $player->birthday }}</p>
                      <p class="card-text">Edad: {{ $player->age }}</p>
                      <p class="card-text">Dorsal: {{ $player->number }}</p>
                      <p class="card-text">Goles: {{ $player->gols }}</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection