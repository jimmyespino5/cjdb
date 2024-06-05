@extends('layouts.app')

@section('titulo')
    Equipos del delegado {{$user->name}}
@endsection

@section('contenido')
    
<section class="container mx-auto mt-10">
    <div>
        <nav class="flex gap-2 items-center flex-wrap md:flex-nowrap mb-5">
            <a href="{{route('tournments.create')}}"
                class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Crear Torneo
            </a>
        </nav> 
    </div>
    <div class="grid md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @foreach ($tournments as $tournment)
                <div class="flex flex-col gap-2 w-48 justify-evenly flex-wrap border p-5">
                    <p class="font-mono font-bold">Nombre: <span class="font-normal">{{$tournment->name}}</span></p>
                    <p class="font-mono font-bold">Equipos: <span class="font-normal">{{$tournment->teams}}</span></p>
                    <p class="font-mono font-bold">Fecha Inicio: <span class="font-normal">{{$tournment->date}}</span></p>
                    <p class="font-mono font-bold">Disponible: <span class="font-normal"> {{$tournment->available ? "Si" : "No"}}</span></p>
                    <p class="font-mono font-bold">Cantidad de grupos: <span class="font-normal"> {{$tournment->groups}}</span></p>
                    <div class="flex gap-2">
                        <a href="{{route('tournments.edit', $tournment)}}" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">Editar</a>
                        <form action="{{route('tournments.destroy', $tournment)}}" method="POST" >
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