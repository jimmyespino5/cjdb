@extends('layouts.app')

@section('titulo')

    Bienvenido: {{ $user->name }} 

@endsection

@section('contenido')
     @if ($user->role == 1) {{-- Usuario --}}
     
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
                
            @if ($tournment->equipoInscrito($teams->first()->id))
                {{-- <p class="text-gray-800 text-lg mb-3 font-bold">
                    <span class="font-normal"> Deuda </span>
                    0
                </p> --}}
                <p class="text-gray-800 text-lg mb-3 font-bold">
                    <span class="font-normal"> Jugador con mas goles </span>
                    0
                </p>
            @else
                @if ($tournment->registration)
                    <form action="{{route('tournments.enroll')}}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        <div>
                            <p class="font-mono font-bold text-xl "> ¿Desea inscribir su equipo al torneo {{$tournment->name}} ?</p>
                            <input type="hidden" id="enroll" name="enroll" value="{{$tournment->id}}">
                            <input type="hidden" id="team" name="team" value="{{$teams->first()->id}}">
                            <input type="submit" value="Inscribir" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                        </div>
                    </form>
                @endif
            @endif
            </div>
        </div>
    </div>
    @elseif ($user->role == 0) {{-- Admin FUTSAL--}}

        <div class="flex justify-center"> 

            <div class="w-full  flex items-center md:flex-row  gap-4 flex-wrap">
                <div class="flex flex-col justify-between px-5  size-40 md:size-80">
                    <a href="{{route('tournments.index', auth()->user()->name)}}" class="w-full">
                        <img src="{{asset('img/torneo.jpg')}}" alt="imagen torneos">
                    </a>
                    <h1 class="font-black text-center text-2xl">Torneos</h1>
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    @if ($tournment)
                        <a href="{{route('tournments.teams', [$tournment])}}" >
                            <img src="{{asset('img/equipos.jpg')}}" alt="imagen equipos" class="w-full">
                        </a>
                        <h1 class="font-black text-center text-2xl">Equipos</h1>
                    @else
                        <h1 class="font-black text-center text-2xl">No se han creado torneos</h1>
                    @endif
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    <a href="{{route('payments.index', auth()->user()->name)}}">
                        <img src="{{asset('img/pagos.jpg')}}" alt="imagen pagos">
                    </a>
                    <h1 class="font-black text-center text-2xl">Deudas</h1>
                </div>
                
            </div>

        </div>
    @elseif ($user->role == 2) {{-- Admin Escuela--}}
        <div class="w-full  flex items-center md:flex-row  gap-4 flex-wrap">
                <div class="flex flex-col justify-between px-5  size-40 md:size-80">
                    <a href="{{route('regstudent')}}" class="w-full">
                        <img src="{{asset('img/inscribir.avif')}}" alt="imagen torneos">
                    </a>
                    <h1 class="font-black text-center text-2xl">Inscribir</h1>
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    <a href="#" >
                        <img src="{{asset('img/buscar.png')}}" alt="imagen equipos" class="w-full">
                    </a>
                    <h1 class="font-black text-center text-2xl">Buscar Jugador</h1>
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    <a href="{{route('schoolpayments.index')}}" >
                        <img src="{{asset('img/pagos_escuela.png')}}" alt="imagen pagos" class="w-full">
                    </a>
                    <h1 class="font-black text-center text-2xl">Pagos</h1>
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    <a href="{{route('students.lists', auth()->user()->name)}}">
                        <img src="{{asset('img/listas.png')}}" alt="imagen pagos">
                    </a>
                    <h1 class="font-black text-center text-2xl">Listas</h1>
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    <a href="{{route('categories.index', auth()->user()->name)}}">
                        <img src="{{asset('img/categoria.png')}}" alt="imagen pagos">
                    </a>
                    <h1 class="font-black text-center text-2xl">Equipos y Categorias</h1>
                </div>
                <div class="flex flex-col justify-between size-40 md:size-80 px-5 ">
                    <a href="{{route('tournaments.school', auth()->user()->name)}}">
                        <img src="{{asset('img/torneo.png')}}" alt="imagen pagos">
                    </a>
                    <h1 class="font-black text-center text-2xl">Torneos</h1>
                </div>
                
        </div>
    @endif 
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