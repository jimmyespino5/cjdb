@extends('layouts.app')

@section('titulo')
    Ingresar Jugador
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <form action="{{route('tournments.update', $tournment)}}" method="POST" novalidate>
            @method('PUT')
            @csrf
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre
                </label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Nombre del torneo"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror "
                    value="{{$tournment->name}}"
                />
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="teams" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cantidad de equipos
                </label>
                <input 
                    id="teams"
                    name="teams"
                    type="text"
                    placeholder="Nombre y apellido del jugador"
                    class="border p-3 w-full rounded-lg @error('teams') border-red-500 @enderror "
                    value="{{$tournment->teams}}"
                />
                @error('teams')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="date" class="mb-2 block uppercase text-gray-500 font-bold">
                    Fecha de inicio
                </label>
                <input 
                id="date"
                    name="date"
                    type="text"
                    placeholder="Numero del date del jugador"
                    class="border p-3 w-full rounded-lg @error('date') border-red-500 @enderror "
                    value="{{$tournment->date}}"
                    />
                    @error('date')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="available" class="mb-2 uppercase text-gray-500 font-bold">
                        Disponible
                    </label>
                    <select name="available" id="available" class="border p-3 w-full rounded-lg">
                            <option value=0 {{!$tournment->available ? "" : "Selected"}}>No</option>
                            <option value=1 {{$tournment->available ? "Selected" : ""}}>Si</option>
                    </select>
                </div>
                
                <div class="mb-5">
                    <label for="groups" class="mb-2 block uppercase text-gray-500 font-bold">
                        Cantidad de grupos
                    </label>
                    <input 
                        id="groups"
                        name="groups"
                        type="text"
                        placeholder="Nombre y apellido del jugador"
                        class="border p-3 w-full rounded-lg @error('groups') border-red-500 @enderror "
                        value="{{$tournment->groups}}"
                    />
                    @error('groups')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                
                <input 
                type="submit"
                value="Actualizar informacion del torneo"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
        </form>

    </div>
</div>
@endsection