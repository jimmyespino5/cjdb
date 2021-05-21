<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Requests\PlayerFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//Consultar nomina con Cards
    {
        $user = Auth::user();
        if ($user->role == 8){//Usuario es Delegado de Futsal
            $user_team = Team::where('users_id','=',$user->id)
                             ->where('sport','=','2')
                             ->get();
            //dd($user_team->get());
            //dd($user_team->first()->id);
            $players = Player::where('team_id','=',$user_team->first()->id)//Equipos de futsal
                             ->get();
            //dd($players);
        }
        return view('player.index', compact("players"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() //Lista de sus jugadores para editar o eliminar
    {
     //   $players = Player::paginate(10);
        $user = Auth::user();
        if ($user->role == 8 ){//Usuario es Delegado de Futsal
            $user_team = Team::where('users_id','=',$user->id)
                             ->where('sport','=','2')
                             ->get();
            //dd($user_team->get());
            //dd($user_team->first()->id);
            $players = Player::where('team_id','=',$user_team->first()->id)//Equipos de futsal
                             ->paginate(2);
            //dd($players);
        }
        return view('player.list', compact("players"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_team() //El ADMIN puede consultar las nominas de equipos
    {
        $teams = Team::find(1);
        dd($teams->players);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goleadores() 
    {
        $players = Player::where('gols','>','0')
        ->orderBy('gols', 'desc')
        ->orderBy('team_id', 'asc')
        ->get();    
        return view('player.goleadores', compact("players"));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goleadores_public() 
    {
        $players = Player::where('gols','>','0')
        ->orderBy('gols', 'desc')
        ->orderBy('team_id', 'asc')
        ->get();    
        return view('player.goleadores', compact("players"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('player.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerFormRequest $request)
    {
        $player=new Player(); 
        //dd($request);
        $player->id=$request->input('id');
        $player->name=$request->input('name');
        $player->lastname=$request->input('lastname');
        $player->birthday=$request->input('birthday');
        $player->number=$request->input('number');
        $player->age=$request->input('age');
        $player->gols=0;
        $player->play=false;
        $player->team_id=1;

        $player->save();
        return redirect()->route('player.list');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view('player.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view('player.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerFormRequest $request, Player $player)
    {
        $player->id=$request->input('id');
        $player->name=$request->input('name');
        $player->lastname=$request->input('lastname');
        $player->birthday=$request->input('birthday');
        $player->number=$request->input('number');
        $player->age=$request->input('age');
        $player->gols=0;
        $player->play=false;
        $player->team_id=1;

        $player->save();
        return redirect()->route('player.edit',[$player])
                         ->with('message','Jugador Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('player.list');
    }
}
