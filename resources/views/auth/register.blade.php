@extends('layouts.app')

@section('titulo')
    Registrate en Liga Futsal Don Bosco
@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route('register')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror "
                        value="{{old('name')}}"
                    />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="cedula" class="mb-2 block uppercase text-gray-500 font-bold">
                        Cedula
                    </label>
                    <input 
                        id="cedula"
                        name="cedula"
                        type="text"
                        placeholder="Tu numero de cedula de identidad sin puntos"
                        class="border p-3 w-full rounded-lg @error('cedula') border-red-500 @enderror "
                        value="{{old('cedula')}}"
                    />
                    @error('cedula')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="phone" class="mb-2 block uppercase text-gray-500 font-bold">
                        Telefono
                    </label>
                    <input 
                        id="phone"
                        name="phone"
                        type="text"
                        placeholder="Ingrese su numero de telefono"
                        class="border p-3 w-full rounded-lg @error('phone') border-red-500 @enderror "
                        value="{{old('phone')}}"
                    />
                    @error('phone')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="team" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre del equipo
                    </label>
                    <input 
                        id="team"
                        name="team"
                        type="text"
                        placeholder="Ingrese nombre de su equipo"
                        class="border p-3 w-full rounded-lg @error('team') border-red-500 @enderror "
                        value="{{old('team')}}"
                    />
                    @error('team')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror "
                        value="{{old('email')}}"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror "
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input 
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repite tu password"
                        class="border p-3 w-full rounded-lg"
                    />
                    
                </div>

                <input 
                    type="submit"
                    value="Crear Cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>

@endsection