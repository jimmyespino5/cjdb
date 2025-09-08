<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', function (Request $request) {
    ///dd($request);
    $user = User::where('email', $request->input('email'))->first();

    if (!$user || !Hash::check($request->password,$user->password) ){
        return response()->json([
            'message' => 'Credenciales incorrectas',
        ], 401);
    }

    return response()->json([
        'user'=> [
            'name'=> $user->name,
            'email'=> $user->email,
        ],
        'token' => $user->createToken('api')->plainTextToken,
    ]);
    ///$token = $request->user()->createToken($request->token_name);
 
    //return ['token' => $token->plainTextToken];
});

Route::get('/escuela/categoriesteam', [CategoryController::class, 'categoriesteam'])->name('regscategoriesteamtudent')->middleware('auth:sanctum');;
