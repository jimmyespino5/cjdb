<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GameController extends Controller
{
    public function destroy($id){
       // dd("dentro con id " . $id);
        $game = Game::find($id);
        //Gate::authorize('delete',$game);
        
        $game->delete();
        return back();
    }

    public function edit($id){

        $tournment=Tournament::where('available',1)->get()->first();
        
        return view('games.edit', [
            'user'=> auth()->user(),
            'game'=> $id,
            'tournment' => $tournment
        ]);
    }
}
