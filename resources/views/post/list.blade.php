@extends('base')
@section('content')

    @if ($posts != null)
        <table  class="table table-bordered "    >
            <tr>
                <td>
                    Imagen
                </td>
                <td>
                    Titulo
                </td>
                <td>
                    Contenido
                </td>
                <td>
                    Acciones
                </td>
            </tr>
            @foreach($posts as $post)
            <tr>
                <td class="align-middle">
                    <img src="{{asset($post->image)}}" height="200px" alt="..."/>
                </td>
                <td class="">
                    <p> {{ $post->title }} </p>
                </td >
                <td class="">
                    <p> {{ $post->content }} </p>
                </td>
                <td class="align-middle">
                    <a href="{{ route('post.edit',[$post]) }}" class="btn btn-primary">Editar</a>
                    <form action = {{ route('post.destroy',$post) }} method="POST" >
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{$posts->links()}}
    @endif
@endsection