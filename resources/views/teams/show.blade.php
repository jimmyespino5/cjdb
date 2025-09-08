@extends('layouts.app')

@section('titulo')
    {{$team->first()->name}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-3/12 px-10">
        <img src="{{$team->logo ? asset('uploads').'/'.$team->logo : asset('img/sin-logo.jpg')}}" alt="imagen usuario" >
    </div>
    <div class="md:w-7/12 p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <table class="table-auto w-full border-separate border border-slate-950 font-bold " >
            <tbody>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3">Nombre</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">{{$team->name}}</td>
                </tr>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3" >Jugadores inscritos</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">{{$team->cedula}}</td>
                </tr>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3">Deuda Total</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">{{$team->dorsal}}</td>
                </tr>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3">Goles</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">0</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
<div class="grid md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6 mt-8">

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
@endsection