@extends('layouts.app')

@section('titulo')
    Pagos Escuela de Futbol Don Bosco
@endsection

@section('contenido')
 <div class="grid grid-cols-6 gap-6"> {{--class="md:flex md: items-center md:justify-center md:gap-10 md:items-center md:col" --}}

    <div class="p-3">
        <div id="contenedorCarnet" class="mb-5" >
            <label for="carnet" class="mb-2 block uppercase text-gray-500 font-bold">
                Carnet
            </label>
            <input
            id="carnet"
            name="carnet"
            type="text"
            placeholder="Ingrese carnet"
            class="border p-3 w-full rounded-lg @error('carnet') border-red-500 @enderror "
            />
            @error('carnet')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
            @enderror
        </div>
        
        <div id="contenedorName" class="mb-5" >
            <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                Nombre del jugador
            </label>
            <input
            id="name"
            name="name"
            type="text"
            placeholder="Ingrese nombre del jugador"
            class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror "
            />
            @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
            @enderror
        </div>
    </div>

    <div class="col-span-5 p-3">
            <div class="grid grid-cols-6 grid-rows-4 gap-3 mb-5" >
                <div class="row-span-4">
                    Imagen
                </div>
                <div class="col-span-5">
                    Carnet
                </div>
                <div class="col-span-5">
                    Cedula
                </div>
                <div class="col-span-5">
                    Nombre
                </div>
                <div class="col-span-5">
                    Apellido
                </div>
            </div>
            <div class="mb-5">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th colspan="12" class="text text-3xl">2025</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Enero</th>
                            <th>Febrero</th>
                            <th>Marzo</th>
                            <th>Abril</th>
                            <th>Febrero</th>
                            <th>Mayo</th>
                            <th>Junio</th>
                            <th>Julio</th>
                            <th>Agosto</th>
                            <th>Septiembre</th>
                            <th>Octubre</th>
                            <th>Noviembre</th>
                            <th>Diciembre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/OK.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                            <td class="text-center"> <img class="rounded-full w-6 h-6 inline-block" src="{{asset('img/NO.png')}}" alt="image description"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mb-5">
                <label for="payment_type" class="mb-2 block uppercase text-gray-500 font-bold">
                    Tipo de pago
                </label>
                <select name="payment_type" id="payment_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Elija tipo de pago</option>
                    <option value="0"> Inscripción </option>
                    <option value="1"> Mensualidad </option>
                    <option value="2"> Torneo </option>
                </select>
            </div>
            
            <div class="mb-5" id="contenedorTournament" style="display: none;">
                <label for="tournament" class="mb-2 block uppercase text-gray-500 font-bold">
                    Torneo a cancelar
                </label>
                <select name="tournament" id="tournament" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Elija torneo a cancelar</option>
                    <option value="1"> Copa Navidad </option>
                    <option value="2"> Copa Don Bosco </option>
                </select>
            </div>

            <div id="contenedorMount" class="mb-5" style="display: none;">
                <label for="mount" class="mb-2 block uppercase text-gray-500 font-bold">
                    Monto
                </label>
                <input
                id="mount"
                name="mount"
                type="text"
                placeholder="Ingrese monto a pagar"
                class="border p-3 w-full rounded-lg @error('mount') border-red-500 @enderror "
                />
                @error('mount')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5" id="contenedorMonth" style="display: none;">
                <label for="month" class="mb-2 block uppercase text-gray-500 font-bold">
                    Mes a cancelar
                </label>
                <select name="month" id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Elija mes a cancelar</option>
                    <option value="1"> Enero </option>
                    <option value="2"> Febrero </option>
                    <option value="3"> Marzo </option>
                    <option value="4"> Abril </option>
                    <option value="5"> Mayo </option>
                    <option value="6"> Junio </option>
                    <option value="7"> Julio </option>
                    <option value="8"> Agosto </option>
                    <option value="9"> Septiembre </option>
                    <option value="10"> Octubre </option>
                    <option value="11"> Noviembre </option>
                    <option value="12"> Diciembre </option>
                </select>
            </div>

            <div class="mb-5">
                <label for="payment_method" class="mb-2 block uppercase text-gray-500 font-bold">
                    Metodo de pago
                </label>
                <select name="payment_method" id="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Elija metodo de pago</option>
                    <option value="0"> Divisas </option>
                    <option value="1"> Efectivo Bs </option>
                    <option value="2"> Pago Movil </option>
                    <option value="3"> Transferencia </option>
                </select>
            </div>

            <div id="contenedorReference" class="mb-5" style="display: none;">
                <label for="reference" class="mb-2 block uppercase text-gray-500 font-bold">
                    Referencia
                </label>
                <input
                id="reference"
                name="reference"
                type="text"
                placeholder="Ingrese monto a pagar"
                class="border p-3 w-full rounded-lg @error('reference') border-red-500 @enderror "
                />
                @error('reference')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{$message}}</p>
                @enderror
            </div>

                <input 
                    type="submit"
                    value="Guardar Pago"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var payment_type = document.getElementById("payment_type");
        var payment_method = document.getElementById("payment_method");
        var contenedorMount = document.getElementById("contenedorMount");
        var contenedorReference = document.getElementById("contenedorReference");
        var contenedorTournament = document.getElementById("contenedorTournament");
        var contenedorMonth = document.getElementById("contenedorMonth");
        payment_type.addEventListener("change", function() {
            var opcionSeleccionada = this.options[this.selectedIndex]; // Obtiene la opción seleccionada
            if (opcionSeleccionada.value == 0) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorTournament.style.display = 'none'; // Oculta el select
                contenedorMonth.style.display = 'none'; // Oculta el select
            } else if (opcionSeleccionada.value == 1) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorTournament.style.display = 'none'; // Oculta el select
                contenedorMonth.style.display = 'block'; // Oculta el select
            } else if (opcionSeleccionada.value == 2) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorTournament.style.display = 'block'; // Oculta el select
                contenedorMonth.style.display = 'none'; // Oculta el select
            }
        });

        payment_method.addEventListener("change", function() {
            var optionSeleccionada = this.options[this.selectedIndex]; // Obtiene la opción seleccionada

            if (optionSeleccionada.value == 0) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorReference.style.display = 'none'; // Muestra el select
            } else if (optionSeleccionada.value == 1) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorReference.style.display = 'none'; // Muestra el select
            } else if (optionSeleccionada.value == 2) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorReference.style.display = 'block'; // Muestra el select
            } else if (optionSeleccionada.value == 3) {
                contenedorMount.style.display = 'block'; // Muestra el select
                contenedorReference.style.display = 'block'; // Muestra el select
            }
        });
    </script>
@endsection