<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Debt;
use App\Models\Team;
use App\Models\User;
use App\Models\Group;
use App\Models\Category;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TournamentController extends Controller
{
    use ValidatesRequests;

    public function index(){
        $tournments = Tournament::all();
        return view('tournments.index', [
            'tournments'=>$tournments,
            'user'=> auth()->user(),
        ]);
    }

    public function create(){
        return view('tournments.create', [
            'user'=> auth()->user(),
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'=> 'required|min:3|max:30',
            'teams'=> 'required',
            'date'=> 'required',
            'groups'=> 'required',
        ]);
        Tournament::create([
            'name' => $request->name,
            'teams' => $request->teams,
            'date' => $request->date,
            'available' => 0,
            'groups' => $request->groups,
        ]);
        return redirect()->route('tournments.index', auth()->user()->name);
    }

    public function edit(Tournament $tournment){
        return view('tournments.edit', [
            'user'=> auth()->user(),
            'tournment'=> $tournment,
        ]);
    }

    public function update(Request $request, Tournament $tournment){
        $this->validate($request, [
            'name'=> 'required|min:3|max:30',
            'teams'=> 'required',
            'date'=> 'required',
            'groups'=> 'required',
        ]);
        $tournment->update([
            'name' => $request->name,
            'teams' => $request->teams,
            'date' => $request->date,
            'groups' => $request->groups,
            'available' => $request->available,
        ]);
        return redirect()->route('tournments.index', auth()->user()->name);
    }

    public function groups(Tournament $tournment){
        //dd($tournment->id);
        $teams= $tournment->equipos()->get();
        $groups = Group::where('tournament_id',$tournment->id)->get();
        return view('tournments.groups', [
            'user'=> auth()->user(),
            'tournment'=> $tournment,
            'teams' => $teams,
            'groups' => $groups,
            'registration' => 0

        ]);
    }

    public function teams($tournment){
        $tournments = Tournament::all();
        $tournment = Tournament::where('available',1)->get()->first();
        return view('tournments.teams', [
            'tournments'=>$tournments,
            'tournment'=>$tournment,
            'user'=> auth()->user(),
        ]);
    }
    
    public function enroll(Request $request){
        //dd(auth()->user()->teams->first()->id);
        $tournment = Tournament::find($request->enroll);
        $tournment->equipos()->attach($request->team);
        $team_id = auth()->user()->teams->first()->id;
        
        $costo_inscripcion = Cost::where('id',1)->get();
        $deuda_inscripcion = Debt::create([
            'team_id' => $team_id,
            'type' => 3,
            'cost' => $costo_inscripcion->first()->cost,
            'payment' => 0
        ]);
        //dd(auth()->user());
        return back();
    }

    public function open(Request $request){
        $tournment = Tournament::find($request->tournment);
        $tournment->update([
            'registration' => $request->open,
        ]);
        return back();
    }

    //Por revisar
    public function destroy(Tournament $tournment){
       // Gate::authorize('delete',$tournment);
 
        $tournment->delete();
        return redirect()->route('tournments.index', auth()->user()->name);
    }

    public function school(){
        $tournments = Tournament::all();
        $categories = Category::all();
        $teams = Team::where("area",2);
        return view('tournments.school', [
            'tournments'=>$tournments,
            'user'=> auth()->user(),
            'categories' => $categories,
            'teams' => $teams,
        ]);
    }

}
