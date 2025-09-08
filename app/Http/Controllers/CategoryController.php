<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CategoryController extends Controller
{
    use ValidatesRequests;
    
    public function index(){
        $categories=Category::all();
        $teams=Team::where('area',2)->get();
        //dd($team->first()->id); 
        //$players = Player::where('team_id', $team->first()->id)->orderby('dorsal','asc')->get();
        return view('categories.index', [
          //  'players'=>$players,
            'categories' => $categories,
            'teams'=>$teams,
            'user'=> auth()->user(),
        ]);
    }


    public function store(Request $request){
        $this->validate($request, [
            'name'=> 'required',
        ]);
        Category::create([
            'name' => $request->name,
            'year_init' => $request->year_init,
            'year_finish' => $request->year_finish,
        ]);
        return back();
    }

    public function teamstore(Request $request){

        //dd($request);
        
        if ($request->mostrarSelect) {
            $this->validate($request, [
                'name'=> 'required',
            ]);
            $imagenPath="";
            if ($request->cedula_photo) {
                $imagen = $request->file('logo');
                $nombreImagen = Str::uuid() . "." . $imagen->extension();
                $manager = ImageManager::gd();
                $imagenPath = public_path('logos_escuela') . '/' . $nombreImagen;
                $imagenServidor = $manager->read($imagen);
                $imagenServidor->save($imagenPath, 100);
            }        
            $category=Category::find($request->category);
    
            $team= Team::create([
                'name' => $request->name,
                'logo' => $imagenPath,
                'user_id' => auth()->user()->id,
                'area' => 2,
            ]);
    
      ///      $category->teams()->attach($team);
            $team->categories()->attach($category);
        } else {
            $category=Category::find($request->category);
    
            $team= Team::where('id',$request->miSelect)->get()->first();
            ///dd($team);
      ///      $category->teams()->attach($team);
            $team->categories()->attach($category);
        }
        


        return back();
    }

    public function destroy($id){
        //DD($category);
        $category = Category::find($id);
        $category->delete();
        return back();
    }

    public function destroyteam($team){
        //dd($team);
        $team = Team::find($team);
        $team->categories()->detach();
        $team->delete();
        return back();
    }

    public function categoriesteam($team){
        //dd($team);
         $categories_team = Team::where('id',$team)->get()->first();
         $data = $categories_team->categories;

         return response()->json(['mensaje' => $data]);

        //    return response()->json($data);
        ///return "ok entregado";
    }
}
