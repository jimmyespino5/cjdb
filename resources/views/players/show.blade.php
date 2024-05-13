@extends('layouts.app')

@section('titulo')
    {{$player->name}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-3/12 px-10">
        <img src="{{$player->photo ? asset('uploads').'/'.$player->photo : asset('img/sin-foto.jpg')}}" alt="imagen usuario" >
    </div>
    <div class="md:w-7/12 p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <table class="table-auto w-full border-separate border border-slate-950 font-bold " >
            <tbody>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3" >Cedula</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">{{$player->cedula}}</td>
                </tr>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3">Nombre</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">{{$player->name}}</td>
                </tr>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3">Dorsal</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">{{$player->dorsal}}</td>
                </tr>
                <tr>
                    <td  class="border border-slate-700 text-3xl p-3">Goles</td>
                    <td  class="border border-slate-700 text-3xl font-normal p-3">0</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection