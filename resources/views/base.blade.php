<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title> 
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    @section('script_page')
    @show

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    @section('css_page')
    @show
</head>
<body>
<div class="container-fluid container_banner" >
    <div class="row row_banner">
        <div class="col-sm-1 col-md-2"></div> <!--style="background-image: url({ {asset('images/banner/1d.jpg')}})"-->
        <div class="col-sm-10 col-md-8">
            <div class="slider" >
                <div class="container">
                    <img src="{{asset('images/banner/1.jpg')}}" alt="">
                    <img src="{{asset('images/banner/2.jpg')}}" alt="">
                    <img src="{{asset('images/banner/3.jpg')}}" alt="">
                    <img src="{{asset('images/banner/4.jpg')}}" alt="">
                    <img src="{{asset('images/banner/5.jpg')}}" alt="">
                </div>
                <div class="controls">
                  <ul></ul>
                </div>
            </div>
        </div>
        <div class="col-sm-1 col-md-2"></div>
    </div>
</div>

    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light navbar_x">
        <a class="navbar-brand" href="{{ route('index') }}">Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @guest 
                    <!-- Si es publico en general muestra-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            C.J.D.B.
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('nosotros') }}">¿Quienes somos?</a>
                            <a class="dropdown-item" href="{{ route('historia') }}">Nuestra historia</a>
                            <a class="dropdown-item" href="{{ route('ubicacion') }}">¿Donde estamos?</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('service.index') }}">Servicios</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Oratorio
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Menu en Construcción</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Liga de Futbol Don Bosco
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Menu en Construcción</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Liga Futsal Don Bosco
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('position.public_table_futsal') }}">Tablas</a> 
                                <a class="dropdown-item" href="{{ route('player.goleadores_public') }}">Goleadores</a>
                            <a class="dropdown-item" href="#">Galería</a>
                        </div>
                    </li>
                @else
                    @if ($user = Auth::user()->role == 1)
                        <!-- Si esta autenticado y es el admin -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Servicios
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('service.create') }}">Crear</a>
                                <a class="dropdown-item" href="{{ route('service.list') }}">Listar</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Oratorio</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Liga de Futbol Don Bosco
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">INCLUIR CATEGORIAS</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Liga Futsal Don Bosco
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('position.index_table') }}">Tablas</a> 
                                <a class="dropdown-item" href="{{ route('player.goleadores') }}">Goleadores</a>
                                <a class="dropdown-item" href="#">Galería</a>
                            </div>
                        </li>
                    @elseif ($user = Auth::user()->role == 2)
                    <!-- Si esta autenticado y es el Administrador de CJDB -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Servicios
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('service.create') }}">Crear</a>
                            <a class="dropdown-item" href="{{ route('service.list') }}">Listar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Publicaciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('post.create') }}">Crear</a>
                            <a class="dropdown-item" href="{{ route('post.list') }}">Listar</a>
                        </div>
                    </li>
                    @elseif ($user = Auth::user()->role == 3)
                    <!-- Si esta autenticado y es el Administrador de Oratorio -->
                    @elseif ($user = Auth::user()->role == 4)
                    <!-- Si esta autenticado y es el Administrador de Furbol Campo -->
                    @elseif ($user = Auth::user()->role == 5)
                    <!-- Si esta autenticado y es el Administrador de Futsal -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Equipos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('team.create') }}">Crear</a>
                                <a class="dropdown-item" href="{{ route('team.list') }}">Consultar</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Grupos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('position.create') }}">Crear</a>
                                <a class="dropdown-item" href="{{ route('position.index') }}">Consultar</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Jugadores
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('player.create') }}">Agregar</a> 
                                <a class="dropdown-item" href="{{ route('player.list') }}">Consultar y editar</a><!--Listado de jugadores con editar/eliminar-->
                                <a class="dropdown-item" href="{{ route('player.list') }}">Consultar nominas</a><!--ADMIN-->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Jornadas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('result.create') }}">Agregar</a> 
                                <a class="dropdown-item" href="{{ route('result.addresults') }}">Agregar Resultados</a>
                                <a class="dropdown-item" href="{{ route('result.index') }}">Consultar</a><!--Todas las jornadas-->
                                <a class="dropdown-item" href="{{ route('result.listAdmin') }}">Consultar, Editar, Eliminar</a><!--ADMIN Todas las jornadas-->
                                <a class="dropdown-item" href="{{ route('player.goleadores') }}">Consultar por equipo</a><!--ADMIN Jornadas por equipos-->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('position.index_table') }}">Tablas</a> 
                                <a class="dropdown-item" href="{{ route('player.goleadores') }}">Goleadores</a>
                            </div>
                        </li>
                        @elseif ($user = Auth::user()->role == 6)
                        <!-- Si esta autenticado y es Animador Oratorio -->
                        @elseif ($user = Auth::user()->role == 7)
                        <!-- Si esta autenticado y es Delegado Liga de Futbol -->
                        @elseif ($user = Auth::user()->role == 8)
                        <!-- Si esta autenticado y es Delegado Liga de Futsal-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Jugadores
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('player.create') }}">Agregar</a> 
                                    <a class="dropdown-item" href="{{ route('player.list') }}">Consultar y editar</a><!--Listado de jugadores con editar/eliminar-->
                                    <a class="dropdown-item" href="{{ route('player.index') }}">Consultar nomina</a><!--Nomina con Cards-->
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Jornadas
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('result.index') }}">Consultar</a><!--Todas las jornadas-->
                                    <a class="dropdown-item" href="{{ route('result.listMyResults') }}">Consultar mis jornadas</a><!--Jornadas de MI equipo-->
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Consultas
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('position.index_table') }}">Tablas</a> 
                                    <a class="dropdown-item" href="{{ route('player.goleadores') }}">Goleadores</a>
                                </div>
                            </li>
                        @elseif ($user = Auth::user()->role == 9)
                        <!-- Si esta autenticado y es el Encargado de Publicaciones  -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Publicaciones
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('post.create') }}">Crear</a>
                                <a class="dropdown-item" href="{{ route('post.list') }}">Listar</a>
                            </div>
                        </li>
                    @endif
                @endguest
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    
    <!--CONTENIDO-->
    <div id= "contenido_ppal" class="container-fluid">
        <div class="row">
            <div class="col-12 ">
                @section('content')
                    INFO DEL CONTENT 
                @show
            </div>
        </div>
    </div>
   
    @section('footer')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-12">
                    Copyright C.J.D.B.
            </div>
        </div>
    </div>
    @show

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    @section('script_jquery')
    @show
</body>
</html>