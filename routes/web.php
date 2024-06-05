<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TournamentController;

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

Route::get('/{user:name}/tournments', [TournamentController::class, 'index'])->name('tournments.index');
Route::get('/tournments/create', [TournamentController::class, 'create'])->name('tournments.create');
Route::post('/tournment', [TournamentController::class, 'store'])->name('tournments.store');
Route::get('/tournments/{tournment}', [TournamentController::class, 'edit'])->name('tournments.edit');
Route::put('/tournments/{tournment}', [TournamentController::class, 'update'])->name('tournments.update');
Route::delete('/tournments/{tournment}', [TournamentController::class, 'destroy'])->name('tournments.destroy');




Route::get('/{user:name}/payments', [PaymentController::class, 'index'])->name('payments.index');


Route::post('imagenes', [ImageController::class, 'store'])->name('imagenes.store');