@extends('base')
@section('content')
    @if (!$services->isEmpty())
            <div class="container-fluid container_secundario">
                <div class="row ">
                    @foreach ($services as $service)
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{$service->image}}" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">{{$service->name}}</h5>
                          <p class="card-text">@if (strlen($service->description)>30) @php echo substr($service->description, 0, 30)."..." @endphp @else {{$service->description}} @endif</p>
                          <a href="{{ route('service.show',$service) }}" class="btn btn-primary">Ver mas</a>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
    @else
        <h2>No hay servicios</h2>
    @endif

@endsection