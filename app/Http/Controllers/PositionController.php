<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Grupos del torneo
    {
        $user = Auth::user();
        if ($user->role == 5){//Usuario es Admin de Futsal
            $positions = Position::where('ligue','=','2')//Equipos de futsal
                                 ->get();
            //dd($positions->get());
            $groups = Position::where('ligue','=','2') //Cantidad de Grupos de Futsal
                                ->select('group')
                                ->max('group');
        }
        return view('position.index', compact("positions","groups"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_table() //Posiciones del torneo
    {   //dd($user = Auth::user()->role);
        $user = Auth::user();
        if ($user->role == 5 || $user->role == 8){//Usuario es Admin de Futsal o Delegado Futsal
            $positions = Position::where('ligue','=','2')//Equipos de futsal
                                 ->orderBy('PTS', 'desc')
                                 ->orderBy('AVG', 'desc')
                                 ->orderBy('GF', 'desc')
                                 ->get();
            $groups = Position::where('ligue','=','2') //Cantidad de Grupos de Futsal
                              ->select('group')
                              ->max('group');                                 
        }
        return view('position.index_table', compact("positions","groups"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public_table_futsal() //Posiciones del torneo
    {   //dd($user = Auth::user()->role);
        $user = Auth::user();
        $positions = Position::where('ligue','=','2')//Equipos de futsal
                        ->orderBy('PTS', 'desc')
                        ->orderBy('AVG', 'desc')
                        ->orderBy('GF', 'desc')
                        ->get();
        $groups = Position::where('ligue','=','2') //Cantidad de Grupos de Futsal
                            ->select('group')
                            ->max('group');                                 
        
        return view('position.index_table', compact("positions","groups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role == 5){
            $teams = Team::where('sport','=','2') //Equipos de Futsal(2) solo el nombre
                        ->select('name');

            $teamsGroup = Position::where('ligue','=','2') //Equipos y grupo al que pertenecen
                                 ->select('team_id', 'group')    
                                    ->get();

            $groups = Position::where('ligue','=','2') //Cantidad de Grupos de Futsal
                             ->select('group')
                             ->max('group');
        }
        return view('position.create', compact("user","teams","teamsGroup","groups"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position=new Position(); 
        
        $team_id = Team::where('name','=',$request->input('team'))->get('id');
        foreach ($team_id as $team) {
            $idTeam = $team->id;
        }
        $position->team_id=$idTeam;
        $position->JJ=0;
        $position->JG=0;
        $position->JE=0;
        $position->JP=0;
        $position->GF=0;
        $position->GC=0;
        $position->AVG=0;
        $position->PTS=0;

        if(Auth::user()->role == 4 ){//Es de Futbol Campo
            $position->ligue=1;
        }elseif(Auth::user()->role == 5 ){//Es de Futsal
            $position->ligue=2;
        }

        if($request->input('group') == 'A' ){
            $position->group=1;
        }elseif($request->input('group') == 'B' ){
            $position->group=2;
        }elseif($request->input('group') == 'C' ){
            $position->group=3;
        }elseif($request->input('group') == 'D' ){
            $position->group=4;
        }

        if(Auth::user()->role == 4 ){
            $position->categories_id=$request->input('category');
        }elseif(Auth::user()->role == 5 ){//Futsal es solo categoria Libre
            $position->categories_id=1;
        }
        

        

        $position->save();
        return redirect()->route('position.create')->with('message','Equipo agregado satisfactoriamente');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //dd($position);
        $user = Auth::user();
        return view('position.edit', compact('position','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {

        if($request->input('group') == 'A' ){
            $position->group=1;
        }elseif($request->input('group') == 'B' ){
            $position->group=2;
        }elseif($request->input('group') == 'C' ){
            $position->group=3;
        }elseif($request->input('group') == 'D' ){
            $position->group=4;
        }

        $position->save();
        return redirect()->route('position.edit',[$position])
                         ->with('message','Grupo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('position.index');
    }
}
