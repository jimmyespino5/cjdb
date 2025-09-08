@extends('layouts.app')

@section('titulo')
    Crear Jornada
@endsection



@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <form action="{{route('journeys.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-3 p-3 ">
                <div class="mb-5">
                    <label for="number" class="mb-2 block uppercase text-gray-500 font-bold">
                        Numero de jornada
                    </label>
                    <input 
                    id="number"
                    name="number"
                    type="text"
                    placeholder="Numero de jornada"
                    class="border p-3 w-full rounded-lg @error('number') border-red-500 @enderror "
                    value="{{old('number')}}"
                    />
                    @error('name')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror    
                    <input type="hidden" name="tournment" id="tournment" value="{{$tournment->id}}">
                </div>

                <div class="mb-5">
                    <label for="date" class="mb-2 block uppercase text-gray-500 font-bold">
                        Fecha
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
                    <label for="team_a" class="mb-2 block uppercase text-gray-500 font-bold">
                        Equipo A
                    </label>
                    <select name="team_a" id="team_a" class="border p-3 w-full rounded-lg ">
                        <option value="0"> Seleccione equipo </option>
                        @foreach ($tournment->equipos as $team)
                            <option value="{{$team->id}}"> {{$team->name}} </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-5">
                    <label for="team_b" class="mb-2 block uppercase text-gray-500 font-bold">
                        Equipo B
                    </label>
                    <select name="team_b" id="team_b" class="border p-3 w-full rounded-lg ">
                            <option value="0"> Seleccione equipo </option>
                        @foreach ($tournment->equipos as $team)
                            <option value="{{$team->id}}"> {{$team->name}} </option>
                        @endforeach
                    </select>
                </div>
                                
                <div>
                    <input 
                    type="submit"
                    value="Crear jornada"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    />
                </div>

            </div>
        </form>

    </div>
</div>
@endsection