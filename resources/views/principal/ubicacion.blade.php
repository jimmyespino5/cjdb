@extends('base')
@section('css_page')
<link rel="stylesheet" type="text/css" href="{{asset('css/datos.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h2> ¿Donde estamos ubicados </h2>
            <hr>
            <p> Avenida Romulo Gallegos, al lado de la U.E.E. Luis Beltran Prieto Figueroa</p>
        </div>
        <div class="col-1"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <img src="{{asset('images/principal/mapaCjdb.jpg')}}" id="image-map" />
        </div>
        <div class="col-1"></div>
    </div>
</div>
<div id="map"></div>
@endsection

