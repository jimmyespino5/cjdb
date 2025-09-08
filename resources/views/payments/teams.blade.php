@extends('layouts.app')

@section('titulo')
    Deudas de {{$user->teams->first()->name}}
@endsection

@section('contenido')
    
    <section class="container mx-auto mt-10"> 
    
            
            <div class="grid md:grid-cols-4 md:grid-rows-1 gap-2 mb-6 col-span-4">
                <div class="col-span-4 text-center">
                    <p class="font-bold text-3xl m-auto"> Deuda Total <span id="deuda_total">  </span>$ </p>
                    
                    @foreach ($teams as $team)
                            {{dd($team->deudas()->getData())}}
                            @php
                                dd($teams->first()->deudas()->getData());
                                dd($teams->first()->deudas()->getData()->costos[0]);
                                dd($item);
                            @endphp
                    @endforeach
                </div>
            </div>
            
    </section>

@endsection