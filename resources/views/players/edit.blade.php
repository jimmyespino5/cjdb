@extends('layouts.app')

@section('titulo')
    Ingresar Jugador
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>
    <div class="md:w-1/2 p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <form action="{{route('players.update', $player)}}" method="POST" novalidate enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-5">
                <label for="dorsal" class="mb-2 block uppercase text-gray-500 font-bold">
                    Equipo
                </label>
                <select name="team" id="team" class="border p-3 w-full rounded-lg">
                @foreach ($user->teams as $team)
                    <option value="{{$team->id}}">{{$team->name}}</option>
                @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label for="cedula" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cedula
                </label>
                <input 
                    id="cedula"
                    name="cedula"
                    type="text"
                    placeholder="Numero de cedula del jugador"
                    class="border p-3 w-full rounded-lg @error('cedula') border-red-500 @enderror "
                    value="{{$player->cedula}}"
                />
                @error('cedula')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="cedula_photo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Foto de la Cedula
                </label>
                <input 
                id="cedula_photo"
                name="cedula_photo"
                type="file"
                class="border p-3 w-full rounded-lg"
                value="{{$player->cedula}}"
                accept=".jpg, .jpeg, .png"
                />
            </div>
            <div class="mb-5">
                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nombre del jugador
                </label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Nombre y apellido del jugador"
                    class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror "
                    value="{{$player->name}}"
                />
                @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="dorsal" class="mb-2 block uppercase text-gray-500 font-bold">
                    Dorsal
                </label>
                <input 
                    id="dorsal"
                    name="dorsal"
                    type="text"
                    placeholder="Numero del dorsal del jugador"
                    class="border p-3 w-full rounded-lg @error('dorsal') border-red-500 @enderror "
                    value="{{$player->dorsal}}"
                />
                @error('dorsal')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>
            

            <div class="mb-5">
                <input 
                name="imagen"
                type="hidden"
                value="{{$player->photo}}"
                />
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>

            <input 
                type="submit"
                value="Actualizar informacion del Jugador"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </form>

    </div>
</div>
@endsection