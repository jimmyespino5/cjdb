@extends('layouts.app')

@section('titulo')
    Deudas de {{$user->teams->first()->name}}
@endsection

@section('contenido')
    
<section class="container mx-auto mt-10"> 
    @if ($user->role == 0) {{-- Administrador --}}
        Admin Role
    <form class="max-w-sm mx-auto">
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Elige un equipo</option>
            <option value="US">United States</option>
            <option value="CA">Canada</option>
            <option value="FR">France</option>
            <option value="DE">Germany</option>
        </select>
    </form>

     @elseif ($user->role == 1)  {{-- Usuario --}}
        @php
            $arbitrajes = 0;
            $amarillas = 0;
            $rojas = 0;
            $inscription = 0;
            $otros = 0;
            $total =0;
        @endphp
        
        <div class="grid md:grid-cols-4 md:grid-rows-1 gap-2 mb-6 col-span-4">
            <div class="col-span-4 text-center">
                <p class="font-bold text-3xl m-auto"> Deuda Total <span id="deuda_total">  </span>$ </p>
            </div>
        </div>
        <div class="grid md:grid-cols-4 md:grid-rows-2 gap-2 mb-1 text-center">
            <div class="bg-lime-400">
                <p class="font-bold text-lg"> Costo arbitraje {{$costos[1]->cost}}$ </p>
            </div>
            <div class="bg-yellow-300">
                <p class="font-bold text-lg"> Costo multa tarjetas amarillas {{$costos[2]->cost}}$ </p>
            </div>
            <div class="bg-red-600">
                <p class="font-bold text-lg"> Costo multa tarjetas rojas {{$costos[3]->cost}}$ </p>
            </div>
            <div class="b bg-cyan-500">
                <p class="font-bold text-lg"> Costo inscripcion {{$costos[0]->cost}}$ </p>
            </div>
        </div>
        <div class="grid grid-cols-4 md:grid-cols-4 md:grid-rows-2 gap-2">
            <div class="col-span-2 md:col-span-1">
                <table class="table-auto m-auto  text-center w-full rtl:text-right bg-white border border-gray-300 ">
                    <thead class="bg-gray-100 font-bold text-sm lg:text-lg">
                        <tr class="border border-gray-300">
                            <th colspan="2" class="border border-gray-300 px-4 py-2"> Arbitrajes pendientes ( <span id="deuda_arbitrajes">  </span>$ )</th>
                            
                        </tr>
                        <tr>
                            <td class="px-4 py-2"> Jornada </td>
                            <td class="px-4 py-2"> Status Pago </td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($arbitrations->count() > 0)
                            @foreach ($arbitrations as $arbitration)
                                <tr>
                                    <td class="px-4 py-2 text-sm lg:text-base"> {{$arbitration->journey_id}} </td>
                                    <td class="px-4 py-2 text-sm lg:text-base"> {{$arbitration->solvent ? "Cancelado" : "Pendiente" }}  </td>
                                </tr>
                                @if (!$arbitration->solvent)
                                    @php
                                        $arbitrajes = $arbitrajes + $costos[1]->cost;
                                    @endphp
                                @endif
                            @endforeach
                        @else
                        <tr>
                            <td colspan="3" class="px-4 py-2">
                                <p>Sin deuda de arbitrajes</p>
                            </td>
                        </tr>    
                        @endif

                        
                    </tbody>
                </table>
            </div>
            <div class="col-span-2 lg:col-span-1">
                <table class="table-auto m-auto  text-center w-full text-sm rtl:text-right bg-white border border-gray-300">
                    <thead class="bg-gray-100 font-bold lg:text-lg">
                        <tr class="border border-gray-300">
                            <th colspan="4" class="border border-gray-300 px-4 py-2"> Tarjetas amarillas <br> no canceladas ( <span id="deuda_amarillas"></span>$ )</th>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"> Jugador </td>
                            <td class="px-4 py-2"> Dorsal </td>
                            <td class="px-4 py-2"> Cantidad </td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($yellow_cards->count()>0)
                            @foreach ($yellow_cards as $yellow_card)
                                <tr>
                                    <td class="px-4 py-2 text-sm lg:text-base" > {{$yellow_card['player']->name}} </td>
                                    <td class="px-4 py-2 text-sm lg:text-base"> {{$yellow_card['player']->dorsal}} </td>
                                    <td class="px-4 py-2 text-sm lg:text-base"> {{$yellow_card['yellow_cards']}}</td>
                                </tr>
                                @php
                                        $amarillas = $amarillas + $costos[2]->cost;
                                @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-4 py-2">
                                    <p>Sin deuda por tarjetas</p>
                                </td>
                            </tr>    
                        @endif
                        
                    </tbody>
                </table>
            </div>
            <div class="col-span-2 lg:col-span-1">
                <table class="table-auto m-auto  text-center w-full text-sm rtl:text-right bg-white border border-gray-300">
                    <thead class="bg-gray-100 font-bold text-lg">
                        <tr class="border border-gray-300">
                            <th colspan="4" class="border border-gray-300 px-4 py-2"> Tarjetas rojas no canceladas ( <span id="deuda_rojas"></span>$ )</th>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"> Jugador </td>
                            <td class="px-4 py-2"> Dorsal </td>
                            <td class="px-4 py-2"> Cantidad </td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($red_cards->count()>0)
                            @foreach ($red_cards as $red_card)
                            <tr>
                                <td class="px-4 py-2 text-base"> {{$red_card['player']->name}} </td>
                                <td class="px-4 py-2 text-base"> {{$red_card['player']->dorsal}} </td>
                                <td class="px-4 py-2 text-base"> {{$red_card['red_cards']}}</td>
                            </tr>
                            @php
                                $rojas = $rojas + $costos[3]->cost;
                            @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-4 py-2">
                                    <p>Sin deuda por tarjetas</p>
                                </td>
                            </tr>                            
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-span-2 md:col-span-1">
                <table class="table-auto m-auto  text-center w-full text-sm rtl:text-right bg-white border border-gray-300">
                    <thead class="bg-gray-100 font-bold text-lg">
                        <tr class="border border-gray-300">
                            <th colspan="4" class="border border-gray-300 px-4 py-2"> Inscripcion pendiente ( <span id="deuda_inscripcion"></span>$ )</th>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"> Monto Cancelado </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 text-base"> {{$inscripcion ? $inscripcion->payment : 'No existen pagos'}} </td>
                            @php
                                $inscripcion ? $inscription = $costos[0]->cost -$inscripcion->payment : 'No existen pagos';
                            @endphp
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-span-4">
                @php
                    $type = array(1=>"Multa de Balon",2=>"Varios",3=>"Inscripcion");
                @endphp
                <table class="table-auto m-auto  text-center w-full text-sm rtl:text-right bg-white border border-gray-300">
                    <thead class="bg-gray-100 font-bold text-lg">
                        <tr class="border border-gray-300">
                            <th colspan="5" class="border border-gray-300 px-4 py-2"> Otros Pagos ( <span id="deuda_otros"></span>$)</th>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"> Tipo </td>
                            <td class="px-4 py-2"> Monto </td>
                            <td class="px-4 py-2"> Observaciones </td>
                            <td class="px-4 py-2"> Monto pagado </td>
                            <td class="px-4 py-2"> Jornada </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($debts as $debt)
                        <tr>
                            <td class="px-4 py-2 text-base"> {{$type[$debt->type]}} </td>
                            <td class="px-4 py-2 text-base"> {{$debt->cost}}$  </td>
                            <td class="px-4 py-2 text-base"> {{$debt->observation}}  </td>
                            <td class="px-4 py-2 text-base"> {{$debt->payment}}  </td>
                            <td class="px-4 py-2 text-base"> {{$debt->journeys}}  </td>
                        </tr>
                        @php
                            $otros = $otros + $debt->cost;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @php
            $total = $total +$arbitrajes + $amarillas + $rojas + $inscription + $otros
        @endphp
        <script> 
            var costo_arbitrajes="<?php echo $arbitrajes;?>";
            var id_inscripcion = document.getElementById('deuda_arbitrajes');
            id_inscripcion.innerHTML = costo_arbitrajes;

            var costo_amarillas="<?php echo $amarillas;?>";
            var id_amarillas = document.getElementById('deuda_amarillas');
            id_amarillas.innerHTML = costo_amarillas;

            var costo_rojas="<?php echo $rojas;?>";
            var id_rojas = document.getElementById('deuda_rojas');
            id_rojas.innerHTML = costo_rojas;

            var costo_inscripcion="<?php echo $inscription;?>";
            var id_inscripcion = document.getElementById('deuda_inscripcion');
            id_inscripcion.innerHTML = costo_inscripcion;

            var costo_otros="<?php echo $otros;?>";
            var id_otros = document.getElementById('deuda_otros');
            id_otros.innerHTML = costo_otros;

            var costo_total="<?php echo $total;?>";
            var id_total = document.getElementById('deuda_total');
            id_total.innerHTML = costo_total;
        </script>
    </section>
    @endsection