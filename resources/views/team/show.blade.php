@extends('base')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-6 " >
                    <img src="{{asset($team->logo)}}" class="card-img" alt="..."/> 
                  </div>
                  <div class="col-md-6 ">
                    <div class="card-body">
                      <p class="card-title titulo">{{ $team->name }}</p>
                      <p class="card-text">{{ $team->color }}</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection