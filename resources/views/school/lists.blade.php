@extends('layouts.app')

@section('titulo')
    Listados Escuela de Futbol Don Bosco
@endsection

@section('contenido')
<div class="md:flex md: items-center md:justify-center md:gap-10 md:items-center md:col">
    
    <table class="table-auto w-5/6 border">
        <thead>
            <tr>
                <th class="border" colspan="3">Categoria {{-- Agregar Categoria --}} </th> 
                <th colspan="2">Año {{-- Agregar Ano de categoria --}} </th>
            </tr>
            <tr>
                <th class="border" colspan="3">Categoria {{-- Agregar Categoria en SUB--}} </th> 
                <th colspan="2">DEPORTIVO DON BOSCO {{-- Agregar Ano de categoria --}} </th>
                <th colspan="2">Pagos {{-- Agregar Ano de categoria --}} </th>
                <th colspan="2">Asistencias {{-- Agregar Ano de categoria --}} </th>
            </tr>
            <tr >
                <th></th>
                <th>Carnet</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nac</th>
                <th>Cedula</th>
                <th>Fecha de Nacimiento</th>
                <th>Edad</th>
                <th>Mayo</th>
                <th>Junio</th>
                <th>Julio</th>
                <th>Morosidad</th>
                <th>Julio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>11451</td>
                <td>Malcolm Lockyer</td>
                <td>1961</td>
            </tr>
            <tr>
                <td>2</td>
                <td>11452</td>
                <td>The Eagles</td>
                <td>1972</td>
            </tr>
            <tr>
                <td>3</td>
                <td>11453</td>
                <td>Earth, Wind, and Fire</td>
                <td>1975</td>
            </tr>
        </tbody>
    </table>
</div>
        @endsection