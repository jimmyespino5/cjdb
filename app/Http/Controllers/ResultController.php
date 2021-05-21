<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Team;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::orderBy('date', 'asc')
                         ->orderBy('horary', 'asc')
                         ->get();
        return view('result.index', compact("results"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $results = Result::orderBy('date', 'asc')
                         ->orderBy('horary', 'asc')
                         ->get();
        return view('result.indexAdmin', compact("results"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listMyResults()
    {
        $user = Auth::user();
        if ($user->role == 8){//Usuario es Delegado de Futsal
            $user_team = DB::table('teams')->where('users_id','=',$user->id)
                                        ->where('sport','=',2)
                                        ->get("id");
            //dd($user_team->first()->id);
            $results = Result::where('team_id_a','=',$user_team->first()->id)
                             ->orWhere('team_id_b','=',$user_team->first()->id)
                             ->orderBy('date', 'asc')
                             ->orderBy('horary', 'asc')
                             ->get();
        }
        return view('result.listMyResults', compact("results"));
    }

    /**
     * Muestra pantalla para ingreso de resultados de las jornadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function addresults()
    {
        $results = Result::orderBy('calendar', 'asc')->get();
        $calendars = Result::orderBy('calendar', 'asc')->distinct()->get('calendar');
        //dd($calendar);
        return view('result.add_result', compact("results","calendars"));
    }

    /**
     * Peticion AJAX con las jornadas y sus datos
     * 
     * @return \Illuminate\Http\Response
     */
    public function return_results(Request $request) 
    {
        $input = $request->name;
        $results = Result::where('calendar','=',$input)->get();
        
        $results->map(function($result){
            $result->equipoa = Team::where('id','=',$result->team_id_a)->get('name');
            $result->equipob = Team::where('id','=',$result->team_id_b)->get('name');
        });
        return $results;
    }

    /**
     * Salva los resultados y modifica las tablas de posiciones
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveResults(Request $request)
    {
       //dd($request);
        $count = (count($request->input()) - 3)/8;
        $i = 0;
        while($i < $count){ 
            $cont = $i + 2;//Cantidad de jornadas que hay que actualizar
            //Busco y actualizo la jornada en la tabla results
            $results = Result::where('calendar','=', $request->input('select_results'))
                            ->where('date','=', $request->input('fecha_envio'.$cont))
                            ->where('horary','=', $request->input('horario_envio'.$cont))->get();
            foreach($results as $result){
                $result->gols_a=$request->input('resultado_equipo_a'.$cont);
                if($result->gols_a == 0){
                    $result->scorers_a="-";
                }else{
                    $result->scorers_a=$request->input('goleadores_equipo_a'.$cont);
                }   
                $result->gols_b=$request->input('resultado_equipo_b'.$cont);
                if($result->gols_b == 0){
                    $result->scorers_b="-";
                }else{
                    $result->scorers_b=$request->input('goleadores_equipo_b'.$cont);
                }   
                $result->save();
            }   
            $i+=1;
            //busco y actualizo las posiciones en la tabla positions del equipo A
            $positions = Position::where('team_id','=',$request->input('equipo_ia'.$cont))->get();
            $result_team_a=$request->input('resultado_equipo_a'.$cont);
            $result_team_b=$request->input('resultado_equipo_b'.$cont);
            foreach($positions as $position){
                if($result_team_a==$result_team_b){
                    $position->JJ+=1;
                    $position->JE+=1;
                    $position->GF+=$request->input('resultado_equipo_a'.$cont);
                    $position->GC+=$request->input('resultado_equipo_b'.$cont);
                    $position->AVG=$position->GF-$position->GC;
                    $position->PTS+=1;
                }elseif($result_team_a<$result_team_b){
                    $position->JJ+=1;
                    $position->JP+=1;
                    $position->GF+=$request->input('resultado_equipo_a'.$cont);
                    $position->GC+=$request->input('resultado_equipo_b'.$cont);
                    $position->AVG=$position->GF-$position->GC;
                }else{
                    $position->JJ+=1;
                    $position->JG+=1;
                    $position->GF+=$request->input('resultado_equipo_a'.$cont);
                    $position->GC+=$request->input('resultado_equipo_b'.$cont);
                    $position->AVG=$position->GF-$position->GC;
                    $position->PTS+=3;
                }

                $position->save();
            }  

            //Busco a los goleadores del equipo A y les agrego sus goles en la tabla Players
            if ($request->input('goleadores_equipo_a'.$cont) != null){
                $goleadores_a = Str::of($request->input('goleadores_equipo_a'.$cont))->split('/[\s,]+/');
                $cont_goleadores = 0;
                while($cont_goleadores < sizeof($goleadores_a)){
                    $player= Player::where('team_id','=',$request->input('equipo_ia'.$cont))
                                    ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                    //dd($player);
                    $player->first()->gols+=1;
                    $player->first()->save();
                    $cont_goleadores+=1;
                }
            }

            //busco y actualizo las posiciones en la tabla positions del equipo B
            $positionsb = Position::where('team_id','=',$request->input('equipo_ib'.$cont))->get();
            foreach($positionsb as $positionb){
                if($result_team_b==$result_team_a){
                    $positionb->JJ+=1;
                    $positionb->JE+=1;
                    $positionb->GF+=$request->input('resultado_equipo_b'.$cont);
                    $positionb->GC+=$request->input('resultado_equipo_a'.$cont);
                    $positionb->AVG=$positionb->GF-$positionb->GC;
                    $positionb->PTS+=1;
                }elseif($result_team_b<$result_team_a){
                    $positionb->JJ+=1;
                    $positionb->JP+=1;
                    $positionb->GF+=$request->input('resultado_equipo_b'.$cont);
                    $positionb->GC+=$request->input('resultado_equipo_a'.$cont);
                    $positionb->AVG=$positionb->GF-$positionb->GC;
                }else{
                    $positionb->JJ+=1;
                    $positionb->JG+=1;
                    $positionb->GF+=$request->input('resultado_equipo_b'.$cont);
                    $positionb->GC+=$request->input('resultado_equipo_a'.$cont);
                    $positionb->AVG=$positionb->GF-$positionb->GC;
                    $positionb->PTS+=3;
                }
                $positionb->save();
            }  
            //dd($request->input('goleadores_equipo_b'.$cont));
            //Busco a los goleadores del equipo B y les agrego sus goles en la tabla Players
            if ($request->input('goleadores_equipo_b'.$cont) != null){
                $goleadores_b = Str::of($request->input('goleadores_equipo_b'.$cont))->split('/[\s,]+/');
                //dd($goleadores_b[0]);
                $cont_goleadores = 0;
                while($cont_goleadores < sizeof($goleadores_b)){
                    $player= Player::where('team_id','=',$request->input('equipo_ib'.$cont))
                                    ->where('number','=',$goleadores_b[$cont_goleadores])->get();
                    $player->first()->gols+=1;
                    $player->first()->save();
                    $cont_goleadores+=1;
                }
            } 
        }
        return redirect()->route('result.addresults')
                         ->with('message','Jornadas Actualizadas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 4 ){//Es de Futbol Campo
            $teams = Team::where('sport','=','1')->get();
        }elseif(Auth::user()->role == 5 ){//Es de Futsal
            $teams = Team::where('sport','=','2')->get();
        }
        return view('result.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = new Result();

        $result->calendar=$request->input('calendar');
        $result->date=$request->input('date');
        $result->horary=$request->input('horary');

        $team_id = Team::where('name','=',$request->input('team_id_a'))->get('id');
        foreach ($team_id as $team) {
            $idTeamA = $team->id;
        }
        $result->team_id_a=$idTeamA;
        $result->gols_a=-1;
        $result->scorers_a="";

        $team_id = Team::where('name','=',$request->input('team_id_b'))->get('id');
        foreach ($team_id as $team) {
            $idTeamB = $team->id;
        }
        $result->team_id_b=$idTeamB;
        $result->gols_b=-1;
        $result->scorers_b="";

        if(Auth::user()->role == 4 ){//Es de Futbol Campo
            $result->ligue=1;
        }elseif(Auth::user()->role == 5 ){//Es de Futsal
            $result->ligue=2;
        }

        if(Auth::user()->role == 4 ){
            $result->categories_id=$request->input('category');
        }elseif(Auth::user()->role == 5 ){//Futsal es solo categoria Libre
            $result->categories_id=1;
        }

        $result->save();
        return redirect()->route('result.create')->with('message','Jornada agregada satisfactoriamente');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        if(Auth::user()->role == 4 ){//Es de Futbol Campo
            $teams = Team::where('sport','=','1')
                         ->paginate(3);
        }elseif(Auth::user()->role == 5 ){//Es de Futsal
            $teams = Team::where('sport','=','2')
                         ->paginate(3);
        }
        return view('result.edit', compact('result','teams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function editResult(Result $result)
    {

        if(Auth::user()->role == 4 ){//Es de Futbol Campo
            $teams = Team::where('sport','=','1')->get();
        }elseif(Auth::user()->role == 5 ){//Es de Futsal
            $teams = Team::where('sport','=','2')->get();
        }
        return view('result.editResult', compact('result','teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        $result->calendar=$request->input('calendar');
        $result->date=$request->input('date');
        $result->horary=$request->input('horary');

        $team_id = Team::where('name','=',$request->input('team_id_a'))->get('id');
        foreach ($team_id as $team) {
            $idTeamA = $team->id;
        }
        $result->team_id_a=$idTeamA;

        $team_id = Team::where('name','=',$request->input('team_id_b'))->get('id');
        foreach ($team_id as $team) {
            $idTeamB = $team->id;
        }
        $result->team_id_b=$idTeamB;
        
        $result->save();
        return redirect()->route('result.edit',[$result])
                         ->with('message','Jornada Actualizada');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function updateResult(Request $request, Result $result)
    {
        //dd($request);
        $result->gols_a=$request->input('gols_a');//Modifico Resultados
        $result->gols_b=$request->input('gols_b');//Modifico Resultados
        $result->scorers_a=$request->input('scorers_a');//Modifico Resultados
        $result->scorers_a=$request->input('scorers_b');//Modifico Resultados

        //Busco posicion del equipo A y revierto el resultado anterior
        $positions = Position::where('team_id','=',$request->input('team_a_envio'))->get();
        foreach($positions as $position){
            if($request->input('old_gols_a')<0){
            
            }elseif($request->input('old_gols_a')==$request->input('old_gols_b')){
                $position->JJ-=1;
                $position->JE-=1;
                $position->GF-=$request->input('old_gols_a');
                $position->GC-=$request->input('old_gols_b');
                $position->AVG=$position->GF-$position->GC;
                $position->PTS-=1;
            }elseif($request->input('old_gols_a')<$request->input('old_gols_b')){
                $position->JJ-=1;
                $position->JP-=1;
                $position->GF-=$request->input('old_gols_a');
                $position->GC-=$request->input('old_gols_b');
                $position->AVG=$position->GF-$position->GC;
            }else{
                $position->JJ-=1;
                $position->JG-=1;
                $position->GF-=$request->input('old_gols_a');
                $position->GC-=$request->input('old_gols_b');
                $position->AVG=$position->GF-$position->GC;
                $position->PTS-=3;
            }
            //Ingreso resultados nuevos del equipo A, despues de revertir juego pasado
            $result_team_a=$request->input('gols_a');
            $result_team_b=$request->input('gols_b');
            if($request->input('old_gols_a')<0){
            
            }
            elseif($result_team_a==$result_team_b){
                $position->JJ+=1;
                $position->JE+=1;
                $position->GF+=$request->input('gols_a');
                $position->GC+=$request->input('gols_b');
                $position->AVG=$position->GF-$position->GC;
                $position->PTS+=1;
            }elseif($result_team_a<$result_team_b){
                $position->JJ+=1;
                $position->JP+=1;
                $position->GF+=$request->input('gols_a');
                $position->GC+=$request->input('gols_b');
                $position->AVG=$position->GF-$position->GC;
            }else{
                $position->JJ+=1;
                $position->JG+=1;
                $position->GF+=$request->input('gols_a');
                $position->GC+=$request->input('gols_b');
                $position->AVG=$position->GF-$position->GC;
                $position->PTS+=3;
            }
            $position->save();
        }  
        
        //Busco a los goleadores del equipo A y les revierto sus goles en la tabla Players
        if ($request->input('old_scorers_a') != 0){
            $goleadores_a = Str::of($request->input('old_scorers_a'))->split('/[\s,]+/');
            $cont_goleadores = 0;
            while($cont_goleadores < sizeof($goleadores_a)){
                $player= Player::where('team_id','=',$request->input('team_a_envio'))
                                ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                //dd($player);
                $player->first()->gols-=1;
                $player->first()->save();
                $cont_goleadores+=1;
            }
        }
        //Busco a los goleadores del equipo A y les agrego sus goles en la tabla Players
        if ($request->input('scorers_a') != null){
            $goleadores_a = Str::of($request->input('scorers_a'))->split('/[\s,]+/');
            $cont_goleadores = 0;
            while($cont_goleadores < sizeof($goleadores_a)){
                $player= Player::where('team_id','=',$request->input('team_a_envio'))
                                ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                //dd($player);
                $player->first()->gols+=1;
                $player->first()->save();
                $cont_goleadores+=1;
            }
        }
        
        //Busco posicion del equipo B y revierto el resultado anterior
        $positionsb = Position::where('team_id','=',$request->input('team_b_envio'))->get();
        foreach($positionsb as $positionb){
            if($request->input('old_gols_b')==$request->input('old_gols_a')){
                $positionb->JJ-=1;
                $positionb->JE-=1;
                $positionb->GF-=$request->input('old_gols_b');
                $positionb->GC-=$request->input('old_gols_a');
                $positionb->AVG=$positionb->GF-$positionb->GC;
                $position->PTS-=1;
            }elseif($request->input('old_gols_b')<$request->input('old_gols_a')){
                $positionb->JJ-=1;
                $positionb->JP-=1;
                $positionb->GF-=$request->input('old_gols_b');
                $positionb->GC-=$request->input('old_gols_a');
                $positionb->AVG=$positionb->GF-$positionb->GC;
            }else{
                $positionb->JJ-=1;
                $positionb->JG-=1;
                $positionb->GF-=$request->input('old_gols_b');
                $positionb->GC-=$request->input('old_gols_a');
                $positionb->AVG=$positionb->GF-$positionb->GC;
                $positionb->PTS-=3;
            }
        //Ingreso resultados nuevos del equipo A, despues de revertir juego pasado
            if($result_team_b==$result_team_a){
                $positionb->JJ+=1;
                $positionb->JE+=1;
                $positionb->GF+=$request->input('gols_b');
                $positionb->GC+=$request->input('gols_a');
                $positionb->AVG=$positionb->GF-$positionb->GC;
                $positionb->PTS+=1;
            }elseif($result_team_b<$result_team_a){
                $positionb->JJ+=1;
                $positionb->JP+=1;
                $positionb->GF+=$request->input('gols_b');
                $positionb->GC+=$request->input('gols_a');
                $positionb->AVG=$positionb->GF-$positionb->GC;
            }else{
                $positionb->JJ+=1;
                $positionb->JG+=1;
                $positionb->GF+=$request->input('gols_b');
                $positionb->GC+=$request->input('gols_a');
                $positionb->AVG=$positionb->GF-$positionb->GC;
                $positionb->PTS+=3;
            }
            $positionb->save();
        }
        
        //Busco a los goleadores del equipo B y les revierto sus goles en la tabla Players
        if ($request->input('old_scorers_b') != 0){
            $goleadores_a = Str::of($request->input('old_scorers_b'))->split('/[\s,]+/');
            $cont_goleadores = 0;
            while($cont_goleadores < sizeof($goleadores_a)){
                $player= Player::where('team_id','=',$request->input('team_b_envio'))
                                ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                //dd($player);
                $player->first()->gols-=1;
                $player->first()->save();
                $cont_goleadores+=1;
            }
        }
        //Busco a los goleadores del equipo B y les agrego sus goles en la tabla Players
        if ($request->input('scorers_b') != null){
            $goleadores_a = Str::of($request->input('scorers_b'))->split('/[\s,]+/');
            $cont_goleadores = 0;
            while($cont_goleadores < sizeof($goleadores_a)){
                $player= Player::where('team_id','=',$request->input('team_b_envio'))
                                ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                //dd($player);
                $player->first()->gols+=1;
                $player->first()->save();
                $cont_goleadores+=1;
            }
        }
        
        $result->save();
        return redirect()->route('result.editResult',[$result])
                         ->with('message','Jornada y Tablas editadas exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
       //dd($result);
        $user = Auth::user();
        if ($user->role == 5){//Usuario es Admin de Futsal
            $positions = Position::where('team_id','=',$result->team_id_a)
                                    ->where('ligue','=',2)//2 es Liga Futsal
                                    ->get();
        }
        //Busco posicion del equipo A y revierto el resultado anterior
        foreach($positions as $position){
            if($result->gols_a<0){
            
            }elseif($result->gols_a==$result->gols_b){
                $position->JJ-=1;
                $position->JE-=1;
                $position->GF-=$result->gols_a;
                $position->GC-=$result->gols_b;
                $position->AVG=$position->GF-$position->GC;
                $position->PTS-=1;
            }elseif($result->gols_a<$result->gols_b){
                $position->JJ-=1;
                $position->JP-=1;
                $position->GF-=$result->gols_a;
                $position->GC-=$result->gols_b;
                $position->AVG=$position->GF-$position->GC;
            }else{
                $position->JJ-=1;
                $position->JG-=1;
                $position->GF-=$result->gols_a;
                $position->GC-=$result->gols_b;
                $position->AVG=$position->GF-$position->GC;
                $position->PTS-=3;
            }
            $position->save();
        }

        //Busco a los goleadores del equipo A y les revierto sus goles en la tabla Players
        if ($result->scorers_a != 0){
            $goleadores_a = Str::of($result->scorers_a)->split('/[\s,]+/');
            $cont_goleadores = 0;
            while($cont_goleadores < sizeof($goleadores_a)){
                $player= Player::where('team_id','=',$result->team_id_a)
                                ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                //dd($player);
                $player->first()->gols-=1;
                $player->first()->save();
                $cont_goleadores+=1;

            }
        }

        //Busco posicion del equipo B y revierto el resultado anterior
        $positionsb = Position::where('team_id','=',$result->team_id_b)->get();
        foreach($positionsb as $positionb){
            if($result->gols_b==$result->gols_a){
                $positionb->JJ-=1;
                $positionb->JE-=1;
                $positionb->GF-=$result->gols_b;
                $positionb->GC-=$result->gols_a;
                $positionb->AVG=$positionb->GF-$positionb->GC;
                $position->PTS-=1;
            }elseif($result->gols_b<$result->gols_a){
                $positionb->JJ-=1;
                $positionb->JP-=1;
                $positionb->GF-=$result->gols_b;
                $positionb->GC-=$result->gols_a;
                $positionb->AVG=$positionb->GF-$positionb->GC;
            }else{
                $positionb->JJ-=1;
                $positionb->JG-=1;
                $positionb->GF-=$result->gols_b;
                $positionb->GC-=$result->gols_a;
                $positionb->AVG=$positionb->GF-$positionb->GC;
                $positionb->PTS-=3;
            }
            $positionb->save();
        }
        //Busco a los goleadores del equipo B y les revierto sus goles en la tabla Players
        if ($result->scorers_b != 0){
            $goleadores_a = Str::of($result->scorers_b)->split('/[\s,]+/');
            $cont_goleadores = 0;
            while($cont_goleadores < sizeof($goleadores_a)){
                $player= Player::where('team_id','=',$result->team_id_b)
                                ->where('number','=',$goleadores_a[$cont_goleadores])->get();
                //dd($player);
                $player->first()->gols-=1;
                $player->first()->save();
                $cont_goleadores+=1;
            }
        }

        $result->delete();
        return redirect()->route('result.listAdmin');
    }
}
