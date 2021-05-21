@extends('base')
@section('content')
    @if (!$players->isEmpty())
            <div class="container-fluid container_secundario">
                <div class="row ">
                    <div class="col-2">
                        
                    </div>
                    <div class="col-8">

                        <table class="table table-bordered">
                            <tr>
                            <td>
                                Nombre
                            </td>
                            <td>
                                Equipo
                            </td>
                            <td>
                                Dorsal
                            </td>
                            <td>
                                Goles
                            </td>
                        </tr>
                    @foreach ($players as $player)
                    <tr>
                        <td>
                            {{$player->name}}
                        </td>
                        <td>
                            {{$player->team->name}}
                        </td>
                        <td>
                            {{$player->number}}
                        </td>
                        <td>
                            {{$player->gols}}
                        </td>
                    </tr>
                    @endforeach
                    </div>
                    <div class="col-2">

                    </div>
                </div>
            </div>
    @else
        <h2>No hay goleadores todavía</h2>
    @endif

@endsection