@extends('base')
@section('css_page')
    <link rel="stylesheet" type="text/css" href="{{asset('css/index.css')}}">
@endsection
@section('content')

    @if ($posts != null)
        @foreach($posts as $post)
            @if ($loop->first)
                <div class="container-fluid container_ppal">
                    <div class="row">
                        <div class="col-md-8 col-sm-12 div_ppal">
                            <div class="card mb-3 card_principal" >
                                <div class="row no-gutters card_principal">
                                  <div class="col-md-6" >
                                    <img src="{{asset($post->image)}}" class="card-img" alt="..."> 
                                  </div>
                                  <div class="col-md-6">
                                    <div class="card-body">
                                        <p class="card-title titulo">{{ $post->title }}</p>
                                        <p class="card-text">{{ $post->content }}</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4">
            @elseif ($loop->iteration == 2)
                            <div class="card mb-1 " style="height: 50%" >
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{asset($post->image)}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <p class="card-title titulo_sec">{{ $post->title }}</p>
                                    <p class="card-text"> @if (strlen($post->content)>30) @php echo substr($post->content, 0, 30)."..." @endphp @else {{$post->content}} @endif</p>
                                    <footer class="blockquote-footer"> <a href="{{ route('post.show',[$post]) }}" class="btn btn-primary btn-sm"> Leer mas  </a> </footer>
                                    </div>
                                </div>
                                </div>
                            </div>
            @elseif ($loop->iteration == 3)
                            <div class="card" style="height: 50%">
                                <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{asset($post->image)}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                    <p class="card-title titulo_sec">{{ $post->title }}</p>
                                    <p class="card-text"> @if (strlen($post->content)>30) @php echo substr($post->content, 0, 30)."..." @endphp @else {{$post->content}} @endif</p>
                                    <footer class="blockquote-footer"> <a href="{{ route('post.show',[$post]) }}" class="btn btn-primary btn-sm"> Leer mas  </a> </footer>
                                    </div>
                                </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
            <div class="container-fluid container_secundario">
                <div class="row  justify-content-center h-100">
                    @foreach ($posts as $post)
                    @if ($loop->iteration > 3)
                    <div class="col-md-2 col-sm-12 div_secundario  align-self-center text-center">
                        <div class="card notice">
                            <img src="{{$post->image}}"  class="card-img-top imagen_noticia" alt="..." >
                            <div class="card-body">
                                <p class="card-title titulo_sec"> @if (strlen($post->title)>20) @php echo substr($post->title, 0, 20)."..." @endphp @else {{$post->title}} @endif</p>
                                <footer class="blockquote-footer"> <a href="{{ route('post.show',[$post]) }}" class="btn btn-primary btn-sm"> Leer mas  </a> </footer>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div> 
    @else
        <h2>No hay noticias</h2>
    @endif

@endsection