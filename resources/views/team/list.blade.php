@extends('base')
@section('content')
    
    @if ($teams != null)
        <table  class="table table-bordered "    >
            <tr>
                <td> 
                    Logo
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Color
                </td>
                <td>
                    Acciones
                </td>                   
            </tr>
            @foreach($teams as $team)
            <tr>
                <td class="align-middle">
                    <img src="{{asset($team->logo)}}" height="200px" alt="..."/>
                </td>
                
                <td class="">
                    <p> {{ $team->name }} </p>
                </td >
                <td class="">
                    <p> {{ $team->color }} </p>
                </td>
                <td class="align-middle">
                    <a href="{{ route('team.edit',[$team]) }}" class="btn btn-primary">Editar</a>
                    <form action = {{ route('team.destroy',$team) }} method="POST" >
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$teams->links()}}
        <div id="separate"></div>
    @endif
@endsection