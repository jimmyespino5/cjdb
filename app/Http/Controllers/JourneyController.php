<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Journey;
use App\Models\Tournament;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Validation\ValidatesRequests;

class JourneyController extends Controller
{
    use ValidatesRequests;
    public function index(){
        $tournment=Tournament::where('available',1)->get()->first();
        //dd($tournment);

        if (auth()->user()->role == 1) {
            $journeys = Journey::where('tournament_id', $tournment->id)
            ->join('games', 'journeys.id', '=', 'games.journey_id')
            ->where(function (Builder $query) {
                $user = User::where('id',auth()->user()->id);
                $query->where('team_a_id', '=', $user->get()->first()->teams()->first()->id)
                ->orWhere('team_b_id', '=', $user->get()->first()->teams()->first()->id);
            })
            ->select('journeys.number as num_jornada', 'team_a_id', 'goals_a', 'team_b_id', 'goals_b', 'date')
            ->get();
        } else {
            $journeys = Journey::where('tournament_id', $tournment->id)
                        ->join('games', 'journeys.id', '=', 'games.journey_id')
                        ->select('games.id as game_id','journeys.number as num_jornada', 'team_a_id', 'goals_a', 'team_b_id', 'goals_b', 'date')
                        ->orderBy('num_jornada', 'asc')
                        ->get();
        }
        return view('journeys.index', [
            'journeys'=>$journeys,
            'tournment'=>$tournment,
            //teams
            'user'=> auth()->user(),
        ]);
    }
    
    public function create(){
        $tournment=Tournament::where('available',1)->get()->first();
        
        return view('journeys.create', [
            'user'=> auth()->user(),
            'tournment' => $tournment
        ]);
    }

    public function store(Request $request){
        $journey = Journey::where('tournament_id',$request->tournment)
                          ->where('number',$request->number)->get();
        if ($journey->count() == 0){
            $journey = Journey::create([
                'number' => $request->number,
                'tournament_id' => $request->tournment
            ]);
        }
        
       

        Game::create([
            'journey_id' => $journey->first()->id,
            'team_a_id' => $request->team_a,
            'goals_a' => 0,
            'team_b_id' => $request->team_b,
            'goals_b' => 0,
            'date' => $request->date,
        ]);
        return redirect()->route('journeys.index', auth()->user()->name);
    }

    public function destroy($id){

    }

}
