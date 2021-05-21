@extends('base')
@section('content')
    @if(Session::has('message'))
        <div class="container alert alert-success">
        {{Session::get('message')}}
        </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li> {{ $error }}    
          @endforeach
        </ul>
      </div>
    @endif

  <div class="container" >
    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-11">
                <form method="POST" action="{{ route("result.saveresults") }}" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>
                                <label for="inputJornada">Jornada</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select id="select_results" name="select_results" class="form-control">
                                        <option value="Seleccione jornada" selected>Seleccione Jornada</option>
                                        @foreach ($calendars as $calendar)
                                        <option value="{{$calendar->calendar}}">{{$calendar->calendar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                        <table name ="results" id= "results" class="table table-bordered table-hover table-sm tabla_resultados">
                        <tr id = "1">
                            <td>
                                Fecha
                            </td>
                            <td>
                                Horario
                            </td>
                            <td>
                                Goles
                            </td>
                            <td>
                                Goleadores 1
                            </td>
                            <td>
                                Equipo 1
                            </td>
                            <td>
                                Equipo 2
                            </td>
                            <td>
                                Goleadores 2
                            </td>
                            <td>
                                Goles
                            </td>
                        </tr>
                        
                        </table>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary"> Guardar </button>
                </form>
        </div>
    </div>
  </div>
@endsection

@section('script_jquery')
<script>
  $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#select_results").change(function(){
        var nFilas = $("#results tr").length; //cantidad de filas en la tabla
        var filas = nFilas - 1;
        var i;
        for (i = 2; i <= filas+1; i++) {
            $("#"+i).remove();
        };
        var id = $('#select_results').val();
        count = 1;
        if(id != 'Seleccione Jornada')
        {
            $.ajax({
                url:"{{ route('result.traer') }}",
                method:'POST',
                data:{'name':id},
                success:function(data){
                    //alert(data.length);
                    i =0;
                    if (data[0].gols_a < 0){
                        while (i < data.length) {
                            $('#' + count).after('<tr id="'+(count+1)+'"><td><p id = "fecha'+(count+1)+'"> </p> <input type="text" name="fecha_envio'+(count+1)+'" id = "fecha_envio'+(count+1)+'" style="display:none;"> </td> <td><p id = "horario'+(count+1)+'"> </p> <input type="text" name="horario_envio'+(count+1)+'" id = "horario_envio'+(count+1)+'" style="display:none;"> </td> <td> <input type="text" class="form_jugador" name="resultado_equipo_a'+(count+1)+'" id="resultado_equipo_a'+(count+1)+'" style="width:40px;"> </td> <td> <input type="text" class="form_jugador" name="goleadores_equipo_a'+(count+1)+'" id="goleadores_equipo_a'+(count+1)+'"> </td> <td> <p id = "equipo_a'+(count+1)+'"> </p> <input type="text" name="equipo_ia'+(count+1)+'" id = "equipo_ia'+(count+1)+'" style="display:none"></td> <td> <p id = "equipo_b'+(count+1)+'"> </p><input type="text" name="equipo_ib'+(count+1)+'" id = "equipo_ib'+(count+1)+'" style="display:none"> </td> <td><input type="text" class="form_jugador" name="goleadores_equipo_b'+(count+1)+'" id="goleadores_equipo_b'+(count+1)+'"> </td> <td><input type="text" class="form_jugador" name="resultado_equipo_b'+(count+1)+'" id="resultado_equipo_b'+(count+1)+'" style="width:40px;"> </td> </tr>');
                            //$('#equipo_a'+(count+1)).text(data[i].team_id_a);
                            //$('#equipo_b'+(count+1)).text(data[i].team_id_b);
                            $('#equipo_a'+(count+1)).text(data[i].equipoa[0].name);
                            $('#equipo_b'+(count+1)).text(data[i].equipob[0].name);
                            $('#horario'+(count+1)).text(data[i].horary);
                            $('#horario_envio'+(count+1)).val(data[i].horary);
                            $('#fecha'+(count+1)).text(data[i].date);
                            $('#fecha_envio'+(count+1)).val(data[i].date);
                            
                            $('#equipo_ia'+(count+1)).val(data[i].team_id_a);
                            $('#equipo_ib'+(count+1)).val(data[i].team_id_b);

                            if (data[i].gols_a == -1){
                                $('#resultado_equipo_a'+(count+1)).attr("placeholder", "-");
                                $('#resultado_equipo_b'+(count+1)).attr("placeholder", "-");
                                $('#goleadores_equipo_a'+(count+1)).attr("placeholder", "-");
                                $('#goleadores_equipo_b'+(count+1)).attr("placeholder", "-");
                            } else{
                            $('#resultado_equipo_a'+(count+1)).attr("placeholder", data[i].gols_a);
                            $('#resultado_equipo_b'+(count+1)).attr("placeholder", data[i].gols_b);
                            $('#goleadores_equipo_a'+(count+1)).attr("placeholder", data[i].scorers_a);
                            $('#goleadores_equipo_b'+(count+1)).attr("placeholder", data[i].scorers_b);
                            }

                            count++;
                            i++;
                        }
                    }else{
                        alert("Esta jornada ya ha sido agregada, procesa a editar sus resultados")
                    }
                }
            });
        }
    });
  });
</script>
@endsection