<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(User $user){
        
        $teams = Team::where('user_id', $user->id)->get();
        $tournment=Tournament::where('available',1)->get()->first();
        //dd($tournment);
        return view('dashboard', [
            'user'=> $user,
            'teams'=> $teams,
            'tournment'=>$tournment
        ]);
    }
        
        
    public function show($id){
        //dd($id);
        $team = Team::where('id', $id)->get()->first();
        $players = Player::where('team_id', $id)->orderby('dorsal','asc')->get();
        //dd($team);
        $tournment=Tournament::where('available',1)->get()->first();
            return view('teams.show', [
                'team'=> $team,
                'tournment'=>$tournment,
                'players'=>$players
            ]);
    }
}
