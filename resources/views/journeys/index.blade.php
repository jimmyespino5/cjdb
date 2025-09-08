@extends('layouts.app')

@section('titulo')
    Juegos del Torneo {{$tournment->name}}
@endsection

@section('contenido')
    
<section class="container mx-auto mt-10">
    <div>
        <nav class="flex gap-2 items-center flex-wrap md:flex-nowrap mb-5">
            @if ($user->role == 0) {{-- Admin --}}
                <a href="{{route('journeys.create')}}"
                    class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Crear Juego
                </a>
            @endif
        </nav> 
    </div>
    <div class="grid md:grid-cols-3 ">
        @if ($journeys->count()==0)
            <h1>No hay juegos creados</h1>
        @else
        <div></div>
            <div>
                <table class="table-auto m-auto border-none text-center w-full text-sm rtl:text-right bg-white border">
                    <thead class="bg-gray-100 font-bold text-lg">
                        <tr class="border-none">
                            <th colspan="8" class=" px-4 py-2"> Jornadas </th>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"> # </td>
                            <td class="px-4 py-2"> Logo </td>
                            <td class="px-4 py-2 whitespace-nowrap"> Equipo A </td>
                            <td class="px-4 py-2"> Goles </td>
                            <td class="px-4 py-2"> vs </td>
                            <td class="px-4 py-2"> Goles </td>
                            <td class="px-4 py-2 whitespace-nowrap"> Equipo B </td>
                            <td class="px-4 py-2"> Logo </td>
                            <td class="px-4 py-2"> Accciones </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($journeys as $journey)
                        <tr>
                            <td class="px-4 py-2 text-base"> {{$journey->num_jornada}} </td>
                            <td class="px-4 py-2 text-base"> {{$tournment->team($journey->team_a_id)->get()->first()->logo ? "Logo" : "Sin logo" }}  </td>
                            <td class="px-4 py-2 whitespace-nowrap"> {{$tournment->team($journey->team_a_id)->get()->first()->name}} </td>
                            <td class="px-4 py-2"> {{$journey->goals_a}} </td>
                            <td class="px-4 py-2"> VS </td>
                            <td class="px-4 py-2"> {{$journey->goals_b}} </td>
                            <td class="px-4 py-2 whitespace-nowrap"> {{$tournment->team($journey->team_b_id)->get()->first()->name}} </td>
                            <td class="px-4 py-2"> {{$tournment->team($journey->team_b_id)->get()->first()->logo ? "Logo" : "Sin logo" }} </td>
                            <td class="flex gap-2 p-4">
                                <a href="{{route('games.edit', $journey->game_id)}}" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer">Jugando</a>
                                <form action="{{route('games.destroy', $journey->game_id)}}" method="POST" >
                                @method('DELETE')
                                @csrf
                                <input 
                                type="submit" 
                                value="Eliminar"
                                class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"  
                                />
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>

@endsection