@extends('layouts.app')

@section('titulo')
    Inscripcion Escuela de Futbol Don Bosco
@endsection

@section('contenido')
<div class="md:flex md: items-center md:justify-center md:gap-10 md:items-center md:col">
    <form class="w-full" action="{{route('register')}}" method="POST" novalidate>
    @csrf
    <div class="md:grid md:grid-cols-2 justify-items-center">

        <div class="md:w-3/4 bg-white p-6 rounded-lg shadow-xl">
            <div class="mb-5">
                <label for="carnet" class="mb-2 block uppercase text-gray-500 font-bold">
                    carnet
                </label>
                <input 
                id="carnet"
                name="carnet"
                type="text"
                placeholder="Tu numero de carnet"
                class="border p-3 w-full rounded-lg @error('carnet') border-red-500 @enderror "
                value="{{old('carnet')}}"
                />
                @error('carnet')
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
                <label for="lastname" class="mb-2 block uppercase text-gray-500 font-bold">
                    Apellido
                </label>
                <input 
                id="lastname"
                name="lastname"
                type="text"
                placeholder="Tu nombre"
                class="border p-3 w-full rounded-lg @error('lastname') border-red-500 @enderror "
                value="{{old('lastname')}}"
                />
                @error('lastname')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>
                    
            <div class="mb-5">
                <label for="birthday" class="mb-2 block uppercase text-gray-500 font-bold">
                    Fecha de Nacimiento
                </label>
                <input 
                id="birthday"
                name="birthday"
                type="date"
                placeholder="Ingrese su numero de telefono"
                class="border p-3 w-full rounded-lg @error('birthday') border-red-500 @enderror "
                value="{{old('birthday')}}"
                />
                @error('birthday')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="team" class="mb-2 block uppercase text-gray-500 font-bold">
                    Representante
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
        </div>

        <div class="md:w-3/4 bg-white p-6 rounded-lg shadow-xl">
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
            <div class="mb-5">
                <label for="pay_cash" class="mb-2 block uppercase text-gray-500 font-bold">
                    Monto Inscripcion Divisas
                </label>
                <input 
                id="pay_cash"
                name="pay_cash"
                type="number"
                placeholder="Ingrese su numero de telefono"
                class="border p-3 w-full rounded-lg @error('pay_cash') border-red-500 @enderror "
                value=0
                />
                @error('pay_cash')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>     
            <div class="mb-5">
                <label for="pay_bspv" class="mb-2 block uppercase text-gray-500 font-bold">
                    Monto Inscripcion Bs Punto de Venta
                </label>
                <input 
                id="pay_bspv"
                name="pay_bspv"
                type="number"
                placeholder="Ingrese su numero de telefono"
                class="border p-3 w-full rounded-lg @error('pay_bspv') border-red-500 @enderror "
                value=0
                />
                @error('pay_bspv')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>     
            <div class="mb-5">
                <label for="pay_bspm" class="mb-2 block uppercase text-gray-500 font-bold">
                    Monto Inscripcion Bs Pago movil
                </label>
                <input 
                id="pay_bspm"
                name="pay_bspm"
                type="number"
                placeholder="Ingrese su numero de telefono"
                class="border p-3 w-full rounded-lg @error('pay_bspm') border-red-500 @enderror "
                value=0
                />
                @error('pay_bspm')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>     

        </div>

    </div>
                
        <input 
        type="submit"
        value="Inscribir"
        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg mt-6"
        />
    </form>
        
</div>

<script>

    // async function login(email, password) {
    //     alert('entre');
    //     const response = await fetch('/api/login', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({ email, password }),
    //     });
    //     const data = await response.json();
    //     // Guarda el token en algún lugar (ej. localStorage)
    //     localStorage.setItem('apiToken', data.token);
    //     console.log(data);
    //     return data.token;
    // }
    // login('isidoro@gmail.com','12345678');


    // async function fetchDataFromLaravel() {
    //   try {
    //     const response = await fetch('http://localhost:8000/api/user');
    //     if (!response.ok) {
    //       throw new Error('Network response was not ok');
    //     }
    //     const data = await response.json();
    //     console.log(data);
    //   } catch (error) {
    //     console.error('Error fetching data:', error);
    //   }
    // }
    // fetchDataFromLaravel();


    //import axios from 'axios'; // O usa el import automático si tu framework lo permite

    // ... dentro de una función o hook de tu componente
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        var team = document.getElementById("selectteam");
        var categories = document.getElementById("category");
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        team.addEventListener("change", function() {
   // 'this' se refiere al combobox
            var opcionSeleccionada = this.options[this.selectedIndex]; // Obtiene la opción seleccionada
            var valorSeleccionado = opcionSeleccionada.value; // Obtiene el valor de la opción
            var textoSeleccionado = opcionSeleccionada.text; // Obtiene el texto de la opción

            // console.log("El valor seleccionado es: " + valorSeleccionado);
            // console.log("El texto seleccionado es: " + textoSeleccionado);

            // Aquí puedes poner el código que necesites
            // Por ejemplo, hacer una petición AJAX, llenar otro combobox, etc.
            axios.get('{{ url('/escuela/categoriesteam/')}}/'+valorSeleccionado, {
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => {
                // console.log(response.data.mensaje); // Hola desde Laravel
                categories.options.length = 0;

                var opcionesNuevas = response.data.mensaje;

                if (Array.isArray(opcionesNuevas)) {
                    const base = new Option("Seleccione la categoria", 0); // Crea una nueva opción
                    categories.add(base); // Agrega la opción al combobox
                opcionesNuevas.forEach(opcionData => {
                    // const nuevaOpcion = new Option(opcionData.text, opcionData.value);
                    // selectElement.add(nuevaOpcion);
                    const newOption = new Option(opcionData.name, opcionData.id); // Crea una nueva opción
                    categories.add(newOption); // Agrega la opción al combobox
                });

                } else {
        console.warn('La respuesta no contiene un array válido:', opcionesNuevas);
    }


            })
            .catch(error => {
                console.error('Error al consumir la ruta:', error);
            });
        });


    </script>

        @endsection