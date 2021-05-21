@extends('base')
@section('content')
    
    @if ($services != null)
        <table  class="table table-bordered "    >
            <tr>
                <td> 
                    Imagen
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Descripción
                </td>
                <td>
                    Precio
                </td>
                <td>
                    Ubicación
                </td>        
                <td>
                    Tipo de Servicio
                </td>               
                <td>
                    Encargado
                </td>    
                <td>
                    Acciones
                </td>                     
            </tr>
            @foreach($services as $service)
            <tr>
                <td class="align-middle">
                    <img src="{{asset($service->image)}}" height="200px" alt="..."/>
                </td>
                
                <td class="">
                    <p> {{ $service->name }} </p>
                </td >
                <td class="">
                    <p> {{ $service->description }} </p>
                </td>
                <td class="">
                    <p> {{ $service->price }} </p>
                </td>
                <td class="">
                    <p> {{ $service->location }} </p>
                </td>
                <td class="">
                    <p> {{ $service->type->name }} </p>
                </td>
                <td class="">
                    <p> {{ $service->teacher }} </p>
                </td>                                                                
                <td class="align-middle">
                    <a href="{{ route('service.edit',[$service]) }}" class="btn btn-primary">Editar</a>
                    <form action = {{ route('service.destroy',$service) }} method="POST" >
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$services->links()}}
    @endif
@endsection