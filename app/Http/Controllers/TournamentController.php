<?php

namespace App\Http\Controllers;

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
    
    //Por revisar
    public function destroy(Tournament $tournment){
       // Gate::authorize('delete',$tournment);
 
        $tournment->delete();
        return redirect()->route('tournments.index', auth()->user()->name);
    }
}
