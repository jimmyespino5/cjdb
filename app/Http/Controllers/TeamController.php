<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(User $user){
        
        $teams = Team::where('user_id', $user->id)->get();
            
            return view('dashboard', [
                'user'=> $user,
                'teams'=> $teams,
            ]);
    }
}
