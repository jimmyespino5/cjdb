@extends('layouts.app')

@section('titulo')
    Grupos 
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        
        <form action="{{route('groups.update')}}" method="POST">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-2">
                <div class="items-center  mx-auto">
                        <div>
                        <table class="border-collapse border border-slate-500">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th class="border border-slate-600 p-3">
                                        Equipo
                                    </th>
                                    <th class="border border-slate-600 p-3">
                                        Grupo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $j =0;
                                $array = array("0" => "Seleccione grupo","1" => "A","2" => "B","3" => "C","4" => "D","5" => "E","6" => "F","7" => "G");
                                @endphp
                            @foreach ($teams as $team)
                            <tr>
                                <td class="border border-slate-600 p-3">
                                    @php
                                        $j++
                                    @endphp
                                    {{$j}}
                                </td>
                                <td class="border border-slate-600 p-3">
                                    {{$team->name}}
                                </td>
                                <td class="border border-slate-600 p-3">
                                    @php
                                        $group_team=0;
                                     @endphp     
                                    <select name="{{$team->id}}" id="{{$team->id}}">
                                        @foreach ($groups as $group)
                                            @if ($team->id == $group->team_id)
                                                <option value="{{$group->group}}" selected>{{$array[$group->group]}}</option>
                                                {{$group_team=$group->group}}
                                            @endif
                                        @endforeach
                                        @for ($i = 1; $i <= $tournment->groups; $i++)
                                            @if ($i != $group_team)
                                                <option value={{$i}}>{{$array[$i]}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        <div class="p-2 m-2">
                            <a href="{{route('tournments.index', auth()->user()->name)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Regresar</a>
                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Guardar</button>
                        </div>
                </div>
                <div class="flex flex-col justify-around">
                    @for ($i = 1; $i <= $tournment->groups; $i++)
                        <div>
                            Grupo {{$array[$i]}}
                            <ul class="list-disc list-inside">
                                @foreach ($groups as $group)
                                    @if ($group->group == $i)
                                        <li>{{$teams[$group->team_id-1]->name}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endfor
                </div>
            </div>
        </form>

    </div>
</div>

@endsection