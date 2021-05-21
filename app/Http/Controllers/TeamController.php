<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\TeamFormRequest;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('team.index', compact("teams"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        if(Auth::user()->role == 4 ){//Es de Futbol Campo
            $teams = Team::where('sport','=','1')
                         ->paginate(3);
        }elseif(Auth::user()->role == 5 ){//Es de Futsal
            $teams = Team::where('sport','=','2')
                         ->paginate(3);
        }
        //$teams = Team::paginate(5);
        return view('team.list', compact("teams"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamFormRequest $request)
    {
        $team=new Team(); 
        //dd($request);
        $team->name=$request->input('name');
        $team->color=$request->input('color');

        $file = $request->file('logo'); //obtenemos el campo file definido en el formulario

        if($file == null){ //si cambiaron la imagen, elimino la anterior y la guardo
            $nombre = "images/equipos/vacio.png";//obtenemos el nombre del archivo
            $nombre_file = "equipos/vacio.png";
        } else {
            $nombre = "images/equipos/".$file->getClientOriginalName();//obtenemos el nombre del archivo
            $nombre_file = "equipos/".$file->getClientOriginalName();
        }
        $team->logo=$nombre;

        \Storage::disk('local')->put($nombre_file,  \File::get($file));//indicamos que queremos guardar un nuevo archivo en el disco local

        $team->save();
        return redirect()->route('team.list');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamFormRequest $request, Team $team)
    {
        $team->name=$request->input('name');
        $team->color=$request->input('color');

        $file = $request->file('logo'); //obtenemos el campo file definido en el formulario
        if($file != null){ //si cambiaron la imagen, elimino la anterior y la guardo

            if(Str::of($team->logo)->substr(15) != 'vacio.png'){
                $delete = Str::of($team->logo)->substr(6);
                \Storage::disk('local')->delete($delete);
            }
            
            $nombre = "images/equipos/".$file->getClientOriginalName();//obtenemos el nombre del archivo
            $team->logo=$nombre;
            $nombre_file = "equipos/".$file->getClientOriginalName();
            \Storage::disk('local')->put($nombre_file,  \File::get($file));
        }

        $team->save();
        return redirect()->route('team.edit',[$team])
                         ->with('message','Equipo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $delete = Str::of($team->logo)->substr(6);
        \Storage::disk('local')->delete($delete);

        $team->delete();
        return redirect()->route('team.list');
    }
}
