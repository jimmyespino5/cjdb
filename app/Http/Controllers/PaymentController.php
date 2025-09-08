<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Cost;
use App\Models\Debt;
use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use App\Models\Arbitration;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PaymentController extends Controller
{
    use ValidatesRequests;

    public function index (){
        if (auth()->user()->role == 1) { //Usuario
            $user = User::where('id',auth()->user()->id);
            $data = collect();
                if($user->get()->first()->teams()->count() == 1)
                {
                    $arbitrations = Arbitration::where('team_id',$user->get()->first()->teams()->first()->id)
                                                ->get();
                    //Tarjetas sin pagar por jugador
                    $yellow_cards=collect();
                    $red_cards=collect();
                    $player_cards_nosolvents = Card::select('player_id','type')
                                                ->where('solvent',0)
                                                ->where('team_id',$user->get()->first()->teams()->first()->id)
                                                ->get();//Jugadores de este equipo con tarjetas
                    foreach ($player_cards_nosolvents as $player_cards_nosolvent) {
                        $player_cards_yellow = Card::where('solvent',0)->where('player_id',$player_cards_nosolvent['player_id'])->where('type',1)->count('type');
                        
                        if ($player_cards_yellow > 0 && $player_cards_nosolvent['type'] == 1) {
                            $player=Player::where('id',$player_cards_nosolvent['player_id'])->get()->first();
                            $yellow_cards->push(['player'=>$player,'yellow_cards'=>$player_cards_yellow]);
                        }
                        $player_cards_red = Card::where('solvent',0)->where('player_id',$player_cards_nosolvent['player_id'])->where('type',2)->count('type');
                        if ($player_cards_red > 0 && $player_cards_nosolvent['type'] == 2) {
                            $player=Player::where('id',$player_cards_nosolvent['player_id'])->get()->first();
                            $red_cards->push(['player'=>$player,'red_cards'=>$player_cards_red]);
                        }
                    }
                    $data->push(['arbitrations'=>$arbitrations,'yellow_cards'=>$yellow_cards,'red_cards'=>$red_cards]);

                    //Separar DEBTS de Inscripcion (type=3)
                    $inscripcion = Debt::where('team_id',$user->get()->first()->teams()->first()->id)
                                    ->where('type',3)
                                    ->get()
                                    ->first();

                    $debts = Debt::where('team_id',$user->get()->first()->teams()->first()->id)
                                    ->whereNot('type',3)
                                    ->orderBy('type', 'asc')
                                    ->orderBy('observation', 'asc')
                                    ->get();
                    
                    $costos = Cost::all();
                    
                }
            return view('payments.index', [
                'user' => auth()->user(),
                //'data' => $data,
                'arbitrations'=>$arbitrations,
                'yellow_cards'=>$yellow_cards,
                'red_cards'=>$red_cards,
                'debts'=>$debts,
                'inscripcion'=>$inscripcion,
                'costos'=>$costos
            ]);

        } else { // Administrador
            //dd('Dentro modo Admin');
            $teams = Team::all();
            
            return view('payments.teams', [
                'user'=> auth()->user(),
                'teams'=> $teams
            ]);
        }
    }
}
