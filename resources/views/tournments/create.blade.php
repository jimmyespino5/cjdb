@extends('layouts.app')

@section('titulo')
    Ingresar Torneo
@endsection



@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <form action="{{route('tournments.store')}}" method="POST" novalidate enctype="multipart/form-data">
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
                    value="{{old('name')}}"
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
                    placeholder="Ingrese cantidad de equipos"
                    class="border p-3 w-full rounded-lg @error('teams') border-red-500 @enderror "
                    value="{{old('teams')}}"
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
                    type="date"
                    placeholder="Numero del date del jugador"
                    class="border p-3 w-full rounded-lg @error('date') border-red-500 @enderror "
                    value="{{old('date')}}"
                />
                @error('date')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="groups" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cantidad de grupos
                </label>
                <input 
                    id="groups"
                    name="groups"
                    type="text"
                    placeholder="Ingrese cantidad de grupos"
                    class="border p-3 w-full rounded-lg @error('groups') border-red-500 @enderror "
                    value="{{old('groups')}}"
                />
                @error('groups')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>
        
            <input 
                type="submit"
                value="Crear torneo"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </form>

    </div>
</div>
@endsection