@extends('base')
@section('css_page')
<link rel="stylesheet" type="text/css" href="{{asset('css/showpost.css')}}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3" >
                <div class="row no-gutters">
                  <div class="col-md-6 " >
                    <img src="{{asset($post->image)}}" class="card-img" alt="...">
                  </div>
                  <div class="col-md-6 ">
                    <div class="card-body">
                      <p class="card-title titulo">{{ $post->title }}</p>
                      <hr>
                      <p class="card-text">{{ $post->content }}</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection