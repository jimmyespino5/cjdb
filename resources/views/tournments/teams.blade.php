@extends('layouts.app')

@section('titulo')
    Torneo {{$tournment->name}}
    
@endsection

@section('contenido')
    
<section class="container mx-auto mt-10">
    <div>
        
        <nav class="flex gap-2 items-center flex-wrap md:flex-nowrap mb-5">
            <a href="{{route('players.create')}}"
               class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
               id="btn-agregar"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Agregar Equipo
            </a>

            {{-- <p class="font-black text-center text-xl">{{$players->count()}}/12 Jugadores inscritos</p> --}}
        </nav>
    </div>

    <div class="grid md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6">

        @foreach ($tournment->teams_group()->get() as $team)
                <div class="flex flex-col gap-2 w-48 justify-evenly flex-wrap">
                    <a href="{{route('teams.show', $team->id)}}">
                        <img src="{{$team->logo ? asset('uploads').'/'.$team->logo : asset('img/sin-logo.jpg')}}" alt="imagen usuario" >
                    </a>
                    <p class="font-mono font-bold">Nombre: <span class="font-normal">{{$team->name}}</span></p>
                    @php
                        $array = array("0" => "Sin grupo","1" => "A","2" => "B","3" => "C","4" => "D","5" => "E","6" => "F","7" => "G");
                    @endphp    
                    <p class="font-mono font-bold">Grupo: <span class="font-normal">{{$array[$team->group]}}</span></p>
                    <p class="font-mono font-bold">Delegado: <span class="font-normal">{{$team->user()->get()->first()->name}}</span></p>
                    <div class="flex gap-2">
                        {{-- <a href="{{route('team.edit', $player)}}" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">Editar</a>
                        <form action="{{route('players.destroy', $player)}}" method="POST" >
                            @method('DELETE')
                            @csrf
                            <input 
                            type="submit" 
                            value="Eliminar"
                            class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"  
                            />
                        </form> --}}
                    </div>
                </div>
        @endforeach
    </div>
</section>

@endsection