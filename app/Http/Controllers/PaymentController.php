<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Arbitration;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PaymentController extends Controller
{
    use ValidatesRequests;

    public function index (){
        $user = User::where('id',auth()->user()->id);

        //dd($user->get()->first()->teams()->first()->id);

        if($user->get()->first()->teams()->count() == 1)

        dd($user);
        $arbitration = Arbitration::where('team_id',$user->get()->first()->teams()->first()->id)->get();


        
        return view('players.index', [
            'arbitration'=>$arbitration,
            'user'=> auth()->user(),
        ]);
    }
}
