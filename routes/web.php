<?php

use App\Models\Game;
use App\Models\Attendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\JourneyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\SchoolPaymentController;
use App\Http\Controllers\RegisterStudentController;

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

//Torneo
Route::get('/{user:name}/tournments', [TournamentController::class, 'index'])->name('tournments.index');
Route::get('/tournments/create', [TournamentController::class, 'create'])->name('tournments.create');
Route::post('/tournment', [TournamentController::class, 'store'])->name('tournments.store');
Route::get('/tournments/{tournment}', [TournamentController::class, 'edit'])->name('tournments.edit');
Route::put('/tournments/{tournment}', [TournamentController::class, 'update'])->name('tournments.update');
Route::delete('/tournments/{tournment}', [TournamentController::class, 'destroy'])->name('tournments.destroy');
Route::get('/tournments/{tournment}/groups', [TournamentController::class, 'groups'])->name('tournments.groups');
Route::get('/{tournment:id}/teams', [TournamentController::class, 'teams'])->name('tournments.teams');
Route::post('/tournment/enroll', [TournamentController::class, 'enroll'])->name('tournments.enroll');
Route::post('/tournment/open', [TournamentController::class, 'open'])->name('tournments.open');

//Jornadas
Route::get('/{user:name}/journeys', [JourneyController::class, 'index'])->name('journeys.index');
Route::get('/journeys/create', [JourneyController::class, 'create'])->name('journeys.create');
Route::post('/journeys', [JourneyController::class, 'store'])->name('journeys.store');
Route::delete('/journeys/{journey:id}', [JourneyController::class, 'destroy'])->name('journeys.destroy');

///Juegos
Route::get('/games/{game:id}', [GameController::class, 'edit'])->name('games.edit');
Route::delete('/games/{game:id}', [GameController::class, 'destroy'])->name('games.destroy');

//Pagos
Route::get('/{user:name}/payments', [PaymentController::class, 'index'])->name('payments.index');

//Grupos
Route::put('/groups', [GroupController::class, 'update'])->name('groups.update');

//Equipos
Route::get('/team/{team:id}', [TeamController::class, 'show'])->name('teams.show');

Route::post('imagenes', [ImageController::class, 'store'])->name('imagenes.store');

//Escuela de Futbol Don Bosco
Route::get('escuela/regstudent', [RegisterStudentController::class, 'index'])->name('regstudent');

Route::get('escuela/lists', [StudentController::class, 'index'])->name('students.lists');
Route::get('escuela/teamscategories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('escuela/categoriesteam/{id}', [CategoryController::class, 'categoriesteam'])->name('categories.categoriesteam');
Route::post('escuela/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('escuela/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('escuela/teamstore', [CategoryController::class, 'teamstore'])->name('categories.teamstore');
Route::delete('escuela/teamstore/{team}', [CategoryController::class, 'destroyteam'])->name('categories.destroyteam');
Route::get('escuela/schoolpayments', [SchoolPaymentController::class, 'index'])->name('schoolpayments.index');
Route::get('escuela/tournaments', [TournamentController::class, 'school'])->name('tournaments.school');
Route::get('escuela/asistencia', [AttendanceController::class, 'register'])->name('attendances.register');

