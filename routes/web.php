<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/{user:name}', [TeamController::class, 'index'])->name('teams.index');

Route::get('/{user:name}/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/player/create', [PlayerController::class, 'create'])->name('players.create');
Route::get('/player/{player}', [PlayerController::class, 'show'])->name('players.show');
Route::post('/player', [PlayerController::class, 'store'])->name('players.store');
Route::get('/players/{player}', [PlayerController::class, 'edit'])->name('players.edit');
Route::put('/players/{player}', [PlayerController::class, 'update'])->name('players.update');
Route::delete('/players/{player}', [PlayerController::class, 'destroy'])->name('players.destroy');

Route::post('imagenes', [ImageController::class, 'store'])->name('imagenes.store');