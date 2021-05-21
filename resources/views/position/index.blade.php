@extends('base')
@section('content')
    @if (!$positions->isEmpty())
            <div class="container-fluid container_secundario">
                <div class="row ">
                    <div class="col-10">
                        <table class="table table-bordered ">
                            @php $count = 1 @endphp
                            <tr>
                              @while ($count <= $groups)
                                <td class="align-text-top"> 
                                    <p class="h3"> Grupo {{$count}} </p>
                                </td>
                                @php $count+=1 @endphp
                              @endwhile
                            </tr>
                            @php $count = 1 @endphp
                            <tr>
                                @while ($count <= $groups)
                                    <td class="align-text-top"> 
                                        <table class="table table-borderless ">
                                            @foreach ($positions as $position)
                                                @if($position->group == $count)
                                                <tr>
                                                    <td>
                                                        {{$position->team->name}} {{$position->group}}
                                                    </td>
                                                    <td>
                                                        <form action = {{ route('position.destroy',$position) }} method="POST" >
                                                            @method('DELETE')
                                                            @csrf
                                                            <a href="{{ route('position.edit',[$position]) }}" class="btn btn-primary btn-sm">Editar</a>
                                                            <button class="btn btn-danger btn-sm">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </table>
                                    </td>
                                    @php $count+=1 @endphp
                                @endwhile
                            </tr>
                        </table>
                      </div>
                </div>
            </div>
    @else
        <h2>No hay servicios</h2>
    @endif

@endsection