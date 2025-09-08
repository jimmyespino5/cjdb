<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GroupController extends Controller
{
    use ValidatesRequests;

    public function update(Request $request){
        //dd( $tournment);
        //dd( $request);

        //dd(count($request->all()));
        foreach ($request->except('_token','_method') as $key => $part) {
            $group_edit = Group::where('team_id',$key)->get()->first();
            //dd($group_edit);
            $group_edit->update([
                'group' => $part,
            ]);
        }
        $tournment = Tournament::where('available', 1)->get()->first();
        $teams= $tournment->teams()->get();
        $groups = Group::where('tournament_id',$tournment->id)->get();
        
        return redirect()->route('tournments.groups', [
            'tournment'=> $tournment,
            'user'=> auth()->user(),
            'teams' => $teams,
            'groups' => $groups,
        ]);
    }
}
