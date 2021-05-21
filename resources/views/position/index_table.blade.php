@extends('base')
@section('content')
    
    @if ($positions != null)
        @php $count = 1 @endphp
        @while ($count <= $groups)
            @if ($count == 1)
                <h3> Grupo A </h3>
            @elseif($count == 2)
                <h3> Grupo B </h3>
            @elseif($count == 3)
                <h3> Grupo C </h3>
            @elseif($count == 4)
                <h3> Grupo D </h3>
            @endif
            <table  class="table table-bordered table-sm">
                <tr>
                    <td> 
                        Nombre
                    </td>
                    <td>
                        JJ
                    </td>
                    <td>
                        JG
                    </td>
                    <td>
                        JE
                    </td>
                    <td>
                        JP
                    </td> 
                    <td>
                        GF
                    </td> 
                    <td>
                        GC
                    </td> 
                    <td>
                        AVG
                    </td> 
                    <td>
                        PTS
                    </td> 
                </tr>
                @foreach($positions as $position)
                    @if($position->group == $count)
                        <tr>
                            <td> 
                                {{$position->team->name}}
                            </td>
                            <td>
                                {{$position->JJ}}
                            </td>
                            <td>
                                {{$position->JG}}
                            </td>
                            <td>
                                {{$position->JE}}
                            </td>
                            <td>
                                {{$position->JP}}
                            </td> 
                            <td>
                                {{$position->GF}}
                            </td> 
                            <td>
                                {{$position->GC}}
                            </td> 
                            <td>
                                {{$position->AVG}}
                            </td> 
                            <td>
                                {{$position->PTS}}
                            </td> 
                        </tr>
                    @endif
                @endforeach
            </table>
            @php $count+=1 @endphp   
        @endwhile
        @endif
        @endsection