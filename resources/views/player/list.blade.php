@extends('base')
@section('content')
    
    @if ($players != null)
        <table  class="table table-bordered "    >
            <tr>
                <td>
                    Cédula
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Apellido
                </td>
                <td>
                    Fecha de Nacimiento
                </td>  
                <td>
                    Dorsal
                </td>                 
                <td>
                    Edad
                </td>
                <td>
                    Goles
                </td>
                <td>
                    Equipo
                </td>
                <td>
                    Acciones
                </td>
            </tr>
            @foreach($players as $player)
            <tr>
                <td class="">
                    <p> {{ $player->id }} </p>
                </td >
                <td class="">
                    <p> {{ $player->name }} </p>
                </td>
                <td class="">
                    <p> {{ $player->lastname }} </p>
                </td>
                <td class="">
                    <p> {{ $player->birthday }} </p>
                </td>
                <td class="">
                    <p> {{ $player->number }} </p>
                </td>
                <td class="">
                    <p> {{ $player->age }} </p>
                </td>
                <td class="">
                    <p> {{ $player->gols }} </p>
                </td>
                <td class="">
                    <p> {{ $player->team->name }} </p>
                </td>
                <td class="align-middle">

                    <a href="{{ route('player.edit',[$player]) }}" @if($player->play == 0) class="btn btn-primary" @else class="btn btn-primary disabled" @endif>Editar</a>
                    <form action = {{ route('player.destroy',$player) }} method="POST" >
                        @method('DELETE')
                        @csrf
                        <button  @if($player->play == 0) class="btn btn-danger" @else class="btn btn-danger disabled" @endif >Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$players->links()}}
    @endif
@endsection