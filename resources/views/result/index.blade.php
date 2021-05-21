@extends('base')
@section('content')
    @if (!$results->isEmpty())
    <div class="container-fluid ">
        @php $comp = "" @endphp
        @foreach ($results as $result)
            <div class="row">
                @if ($comp != $result->date)
                    @php $comp = $result->date @endphp
                    <div class="container-fluid  "> <div class="row"> <span> {{\Carbon\Carbon::parse($result->date)->locale('es_ES')->isoFormat('dddd D MMMM YYYY') }} </span></div> </div>
                @endif
                    <div class="col-3">
                        
                    </div>    
                    <div class="col-2" style="display: flex; align-items: center;">
                        <div style="float: left; padding-right:20px">
                            {{$result->team_a->name}}
                        </div>
                        <span>
                            <img class="img" src="{{$result->team_a->logo}}" style="width: 40px; height:40px;">
                        </span>
                    </div>    
                    <div class="col-2">
                        <table class="table table-borderless " style="margin: 0;">
                            <tr >
                                <td style="vertical-align: middle;">
                                    @if($result->gols_a<0)
                                        <h3> - <h3>
                                    @else
                                        {{$result->gols_a}}
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">
                                    {{\Carbon\Carbon::createFromFormat('H:i:s',$result->horary)->format('h:i')}}
                                </td>
                                <td style="vertical-align: middle;">
                                    @if($result->gols_b<0)
                                        <h3> - <h3>
                                    @else
                                        {{$result->gols_b}}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>    
                    <div class="col-2"  style="display: flex; align-items: center;">
                        <span style="float: left; display:inline-block">
                            <img class="img" src="{{$result->team_b->logo}}" style="width: 40px; height:40px;">
                        </span>
                        <div style="padding-left:20px">
                            {{$result->team_b->name}}
                        </div>
                    </div>    
                    <div class="col-3">
                        
                    </div>    
                </div>
            @endforeach
        </div>
    @else
        <h2>No hay jornadas
        </h2>
    @endif

@endsection