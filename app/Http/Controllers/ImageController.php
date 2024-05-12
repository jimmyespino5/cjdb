<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    public function store(Request $request){

        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $manager = ImageManager::gd();
        
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        $imagenServidor = $manager->read($imagen)->resize(480, 640);

        $imagenServidor->save($imagenPath, 100);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
