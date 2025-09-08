<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'logo',
        'user_id',
        'area'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tournments(): BelongsToMany
    {
        return $this->belongsToMany(Tournament::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'team_category');
    }



    public function inscrito(): bool {
        $tournment=Tournament::where('available',1)->get()->first();

        
        return true;
    }

    public function deudas(){
            $this->name;
            $data = collect();

                    $arbitrations = Arbitration::where('team_id',$this->id)
                                                ->get();
                    //Tarjetas sin pagar por jugador
                    $yellow_cards=collect();
                    $red_cards=collect();
                    $player_cards_nosolvents = Card::select('player_id','type')
                                                ->where('solvent',0)
                                                ->where('team_id',$this->id)
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
                    $inscripcion = Debt::where('team_id',$this->id)
                                    ->where('type',3)
                                    ->get()
                                    ->first();

                    $debts = Debt::where('team_id',$this->id)
                                    ->whereNot('type',3)
                                    ->orderBy('type', 'asc')
                                    ->orderBy('observation', 'asc')
                                    ->get();
                    
                    $costos = Cost::all();
                    

            // return view('payments.index', [
            //     'user' => auth()->user(),
            //     //'data' => $data,
            //     'arbitrations'=>$arbitrations,
            //     'yellow_cards'=>$yellow_cards,
            //     'red_cards'=>$red_cards,
            //     'debts'=>$debts,
            //     'inscripcion'=>$inscripcion,
            //     'costos'=>$costos
            // ]);












            return response()->json([
                'user' => auth()->user(),
                //'data' => $data,
                'arbitrations'=>$arbitrations,
                'yellow_cards'=>$yellow_cards,
                'red_cards'=>$red_cards,
                'debts'=>$debts,
                'inscripcion'=>$inscripcion,
                'costos'=>$costos
            ]);
    }
}
