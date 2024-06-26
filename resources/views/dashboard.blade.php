@extends('layouts.app')

@section('titulo')

    Delegado: {{ $user->name }} 
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{$teams->first()->logo ? asset('logos').'/'.$teams->first()->logo : asset('img/sin-logo.jpg')}}" alt="imagen usuario">
                {{-- <img src="{{asset('img/sin-logo.jpg')}}" alt="imagen usuario"> --}}
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <p class="text-gray-800 text-3xl mb-3 font-bold">
                    <span class="font-normal"> Equipo: {{$teams->first()->name}} </span>
                </p>
                <p class="text-gray-800 text-lg mb-3 font-bold">
                    <span class="font-normal"> Deuda </span>
                    0
                </p>
                <p class="text-gray-800 text-lg mb-3 font-bold">
                    <span class="font-normal"> Jugador con mas goles </span>
                    0
                </p>
            </div>
        </div>
    </div>

    {{-- <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Publicaciones
        </h2>

        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                <div>
                    <a href="{{route('posts.show', ['post'=>$post, 'user'=>$user])}}">
                        <img src="{{ asset('uploads') . '/'. $post->imagen}}" alt="Imagen del post {{$post->titulo}} " srcset="">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="my-10">
                {{$posts->links('pagination::tailwind')}}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section> --}}
@endsection