@extends('layouts.app')

@section('titulo')
    Agregar equipo a torneo {{$user->name}}
@endsection

@section('contenido')
    <div class="w-full  grid grid-cols-2 grid-rows-2 gap-4">
               <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0 ">
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="grid grid-cols-1 gap-3 p-3 ">
                            <div class="mb-5">
                                <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Nombre del torneo
                                </label>
                                <input
                                id="name"
                                name="name"
                                type="text"
                                placeholder="Ingrese nombre de la categoria"
                                class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror "
                                value="{{old('name')}}"
                                />
                                @error('date')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <input
                                type="submit"
                                value="Agregar torneo"
                                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                                />
                            </div>
                        </div>
                    </form>
               </div>

                    <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
                        <form action="{{route('categories.teamstore')}}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="mb-5">
                                <label for="selectteam" class="mb-2 block uppercase text-gray-500 font-bold">Equipo</label>
                                <select id="selectteam" class="bg-white-50 border border-white-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option selected>Seleccione el equipo</option>
                                    @foreach ($teams->get() as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                                @error('team')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="category" class="mb-2 block uppercase text-gray-500 font-bold">Categoria</label>
                                <select id="category" class="bg-white-50 border border-white-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option selected>Seleccione la categoria</option>
                                </select>
                                @error('category')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                                @enderror
                            </div>
                                </div>

                                <div>
                                    <input
                                    type="submit"
                                    value="Agregar equipo"
                                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                                    />
                                </div>
                            </div>
                        </form>
                    </div>

                {{-- <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0 flex justify-center">
                    @if ($categories->count() == 0)
                        <p>No se han agregado categorias</p>
                    @else
                        <table class=" w-5/6">
                            <thead>
                                <tr>
                                <th>Nombre</th>
                                <th>Año Inicio</th>
                                <th>Año Fin</th>
                                <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center ">
                                            {{$category->name}}
                                        </td>
                                        <td class="text-center">
                                            {{$category->year_init}}
                                        </td>
                                        <td class="text-center">
                                            {{$category->year_finish}}
                                        </td>
                                        <td>

                                            <form action="{{route('categories.destroy', $category)}}" method="POST" >
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
                    @endif
               </div> --}}

               <div class="md:w-full p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0 flex justify-center">
                  {{--@if ($teams->count() == 0)
                       <p>Aca van los equipos con sus categorias</p>
                   @else
                       {{--<p>Falta desglose de categorias</p>
                         @foreach ($teams as $team)


                        @foreach ($team->categories() as $category)
                            {{dd($category)}}
                        @endforeach
                        @endforeach 
                        <table class=" w-5/6">
                            <thead>
                                <tr>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($categories as $category)
                                    @foreach ($category->teams as $team)
                                        @php
                                        $team_print= App\Models\Team::find($team->pivot->team_id);
                                        $category_print= App\Models\Category::find($team->pivot->category_id);
                                        @endphp
                                        <tr>
                                            <td class="text-center ">
                                                {{$team_print->name}}
                                            </td>
                                            <td class="text-center">
                                                {{$category_print->name}}
                                            </td>
                                            <td>
                                                <form action="{{route('categories.destroyteam', $team_print)}}" method="POST" >
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
                                @endforeach 

                            </tbody>
                        </table>
                   @endif --}}
               </div>
        </div>

@endsection