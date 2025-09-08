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
                    @if ($tournment->available)
                        <h2 class="font-black text-center text-xl bg-green-500 rounded-lg">Habilitado</h2>
                    @else
                        <h2 class="font-black text-center text-xl bg-red-500 rounded-lg">Deshabilitado</h2>
                    @endif
                    <p class="font-mono font-bold">Nombre: <span class="font-normal">{{$tournment->name}}</span></p>
                    <p class="font-mono font-bold">Equipos: <span class="font-normal">{{$tournment->teams}}</span></p>
                    <p class="font-mono font-bold">Equipos Inscritos: <span class="font-normal">{{$tournment->equipos()->count()}}</span></p>
                    <p class="font-mono font-bold">Fecha Inicio: <span class="font-normal">{{$tournment->date}}</span></p>
                    <p class="font-mono font-bold">Disponible: <span class="font-normal"> {{$tournment->available ? "Si" : "No"}}</span></p>
                    <p class="font-mono font-bold">Cantidad de grupos: <span class="font-normal"> {{$tournment->groups}}</span></p>
                    <div class="flex gap-2 flex-wrap">
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
                        <a href="{{route('tournments.groups', $tournment)}}" class="bg-green-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">Grupos</a>
                        @if ($tournment->available)
                            @if ($tournment->registration)
                                <form action="{{route('tournments.open')}}" method="POST" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <input type="submit" value="Cerrar inscripciones" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                                    <input type="hidden" id="open" name="open" value="0">
                                    <input type="hidden" id="tournment" name="tournment" value="{{$tournment->id}}">
                                </form>
                            @else
                                <form action="{{route('tournments.open')}}" method="POST" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <input type="submit" value="Abrir inscripciones" class="bg-green-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">
                                    <input type="hidden" id="open" name="open" value="1">
                                    <input type="hidden" id="tournment" name="tournment" value="{{$tournment->id}}">
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
        @endforeach
    </div>
</section>

@endsection