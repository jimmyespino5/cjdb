<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Player;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\ImageManager;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PlayerController extends Controller
{
    use ValidatesRequests;
    public function index(){
        
        $team=Team::where('user_id',auth()->user()->id)->get();
        //dd($team->first()->id); 
        $players = Player::where('team_id', $team->first()->id)->orderby('dorsal','asc')->get();
        return view('players.index', [
            'players'=>$players,
            'msg'=>"",
            'user'=> auth()->user(),
        ]);
    }

    public function create(){

        //dd(auth()->user()->teams->first()->id);
        if (auth()->user()->teams->count() == 1) {
            $players = Player::where('team_id', auth()->user()->teams->first()->id)->orderby('dorsal','asc')->get();
            if ($players->count() < 12) {
                return view('players.create', [
                    'user'=> auth()->user(),
                ]);
            } else{
                return view('players.index', [
                    'players'=>$players,
                    'msg'=>"Ya alcanzo el numero maximo de jugadores",
                    'user'=> auth()->user(),
                ]);
            }
         } else {
            # code...
        }
        


    }

    public function store(Request $request){

        $this->validate($request, [
            'cedula'=> 'required|max:8',
            'name'=> 'required|min:3|max:30',
            'dorsal'=> 'required',
        ]);
        
        //dd($request);
        
        if ($request->cedula_photo) {
            $imagen = $request->file('cedula_photo');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $manager = ImageManager::gd();
            $imagenPath = public_path('cedulas') . '/' . $nombreImagen;
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->save($imagenPath, 100);
        }
        
        Player::create([
            'cedula' => $request->cedula,
            'cedula_photo' => $nombreImagen ?? '',
            'name' => $request->name,
            'dorsal' => $request->dorsal,
            'photo' => $request->imagen,
            'team_id' => $request->team,
        ]);
        
        
        
        return redirect()->route('players.index', auth()->user()->name);
    }

    public function show(Player $player){
        return view('players.show', [
            'user'=> auth()->user(),
            'player'=> $player,
        ]);
    }
    
    public function edit(Player $player){
        return view('players.edit', [
            'user'=> auth()->user(),
            'player'=> $player,
        ]);
    }
    
    public function update(Request $request, Player $player){
        
        $this->validate($request, [
            'cedula'=> 'required|max:8',
            'name'=> 'required|min:3|max:30',
            'dorsal'=> 'required',
        ]);
        
        //dd($request);
        
        if ($request->cedula_photo) {
            $imagen = $request->file('cedula_photo');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $manager = ImageManager::gd();
            $imagenPath = public_path('cedulas') . '/' . $nombreImagen;
            $imagenServidor = $manager->read($imagen);
            $imagenServidor->save($imagenPath, 100);
        }
        
        $player->update([
            'cedula' => $request->cedula,
            'cedula_photo' => $nombreImagen ?? '',
            'name' => $request->name,
            'dorsal' => $request->dorsal,
            'photo' => $request->imagen,
        ]);
        return redirect()->route('players.index', auth()->user()->name);
    }

    public function destroy(Player $player){
        Gate::authorize('delete',$player);
        //Eliminar imagen
        $imagen_path=public_path('uploads/').$player->photo;
        if ($player->photo) {
            if (File::exists($imagen_path)) {
                unlink($imagen_path);
            }
        }
        $player->delete();
        return redirect()->route('players.index', auth()->user()->name);
    }
}
