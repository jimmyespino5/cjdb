@extends('layouts.app')

@section('titulo')
    Jugadores de {{$user->teams->first()->name}}
    @if ($msg)
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$msg}}</p>
    @endif

    

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
                Agregar Jugador
            </a>

            <p class="font-black text-center text-xl">{{$players->count()}}/12 Jugadores inscritos</p>
        </nav>
    </div>

    <div class="grid md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6">

        @foreach ($players as $player)
                <div class="flex flex-col gap-2 w-48 justify-evenly flex-wrap">
                    <a href="{{route('players.show', $player->id)}}">
                        <img src="{{$player->photo ? asset('uploads').'/'.$player->photo : asset('img/sin-foto.jpg')}}" alt="imagen usuario" >
                    </a>
                    <p class="font-mono font-bold">Nombre: <span class="font-normal">{{$player->name}}</span></p>
                    <p class="font-mono font-bold">Dorsal: <span class="font-normal">{{$player->dorsal}}</span></p>
                    <p class="font-mono font-bold">Cedula: <span class="font-normal">{{$player->cedula}}</span></p>
                    <p class="font-mono font-bold">Goles: <span class="font-normal"> 0</span></p>
                    <div class="flex gap-2">
                        <a href="{{route('players.edit', $player)}}" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">Editar</a>
                        <form action="{{route('players.destroy', $player)}}" method="POST" >
                            @method('DELETE')
                            @csrf
                            <input 
                            type="submit" 
                            value="Eliminar"
                            class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"  
                            />
                        </form>
                    </div>
                </div>
        @endforeach
    </div>
</section>

@endsection