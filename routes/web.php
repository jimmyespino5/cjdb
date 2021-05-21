<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PlayerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get("/conexion" ,function(){
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("No se puede conectar a la DB. Error: ".$e);
    }
});

/*Route::get('/', function () { return view('welcome');});*/
//Rutas Publicas
Route::get('/',[PostController::class, 'index'])->name('index');//este es para el inicio de la pagina
Route::get('/quienessomos',function(){return view('principal.nosotros');})->name('nosotros');
Route::get('/historia',function(){return view('principal.historia');})->name('historia');
Route::get('/ubicacion',function(){return view('principal.ubicacion');})->name('ubicacion');
Route::get('positions/PublicTableFutsal',[PositionController::class, 'public_table_futsal'])->name('position.public_table_futsal');
Route::get('players/goleadores_public',[PlayerController::class, 'goleadores_public'])->name('player.goleadores_public');

Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home');
//Rutas para autenticacion
Route::group(['middleware'=>'verified'],function(){ //Aca van las rutas que necesitan estar logueados 
    
    //Rutas Post
    Route::get('posts',[PostController::class, 'list'])->name('post.list');
    Route::get('posts/create',[PostController::class, 'create'])->name('post.create');
    Route::post('posts',[PostController::class, 'store'])->name('post.store');
    Route::get('posts/{post}/edit',[PostController::class, 'edit'])->name('post.edit');
    Route::put('posts/{post}',[PostController::class, 'update'])->name('post.update');
    Route::delete('posts/{post}',[PostController::class, 'destroy'])->name('post.destroy');
    
    //Rutas Service
    Route::get('services/create',[ServiceController::class, 'create'])->name('service.create');
    Route::get('services/list',[ServiceController::class, 'list'])->name('service.list');
    Route::post('services',[ServiceController::class, 'store'])->name('service.store');
    Route::get('services/{service}/edit',[ServiceController::class, 'edit'])->name('service.edit');
    Route::put('services/{service}',[ServiceController::class, 'update'])->name('service.update');
    Route::delete('services/{service}',[ServiceController::class, 'destroy'])->name('service.destroy');
    
    //Rutas Team
    Route::get('teams',[TeamController::class, 'index'])->name('team.index');//Muestra listado de equipos y opcion Ver Mas
    Route::get('teams/list',[TeamController::class, 'list'])->name('team.list');//ADMIN Listado de equipos
    Route::get('teams/create',[TeamController::class, 'create'])->name('team.create');
    Route::get('teams/{team}',[TeamController::class, 'show'])->name('team.show');
    Route::post('teams',[TeamController::class, 'store'])->name('team.store');
    Route::get('teams/{team}/edit',[TeamController::class, 'edit'])->name('team.edit');
    Route::put('teams/{team}',[TeamController::class, 'update'])->name('team.update');
    Route::delete('teams/{team}',[TeamController::class, 'destroy'])->name('team.destroy');
    
    //Rutas Player
    Route::get('players',[PlayerController::class, 'index'])->name('player.index');
    Route::get('players/list',[TeamController::class, 'list'])->name('player.list');
    Route::get('players/listTeam',[TeamController::class, 'list_team'])->name('player.list_team');
    Route::get('players/goleadores',[TeamController::class, 'goleadores'])->name('player.goleadores');
    Route::get('players/create',[TeamController::class, 'create'])->name('player.create');
    Route::get('players/{player}',[TeamController::class, 'show'])->name('player.show');
    Route::post('players',[TeamController::class, 'store'])->name('player.store');
    Route::get('players/{player}/edit',[TeamController::class, 'edit'])->name('player.edit');
    Route::put('players/{player}',[TeamController::class, 'update'])->name('player.update');
    Route::delete('players/{player}',[TeamController::class, 'destroy'])->name('player.destroy');
    
    //Rutas Position 
    Route::get('positions',[PositionController::class, 'index'])->name('position.index');
    Route::get('positions/table',[PositionController::class, 'index_table'])->name('position.index_table');
    Route::get('positions/create',[PositionController::class, 'create'])->name('position.create');
    Route::get('positions/{position}',[PositionController::class, 'show'])->name('position.show');
    Route::post('positions',[PositionController::class, 'store'])->name('position.store');
    Route::get('positions/{position}/edit',[PositionController::class, 'edit'])->name('position.edit');
    Route::put('positions/{position}',[PositionController::class, 'update'])->name('position.update');
    Route::delete('positions/{position}',[PositionController::class, 'destroy'])->name('position.destroy');
    
    //Rutas Result 
    Route::get('results',[ResultController::class, 'index'])->name('result.index');//listo
    Route::get('resultsList',[ResultController::class, 'indexAdmin'])->name('result.listAdmin');//listo
    Route::get('results/myresults',[ResultController::class, 'listMyResults'])->name('result.listMyResults');//listo
    Route::get('results/addresults',[ResultController::class, 'addresults'])->name('result.addresults');//listo
    Route::get('results/create',[ResultController::class, 'create'])->name('result.create');//listo
    Route::get('results/{result}',[ResultController::class, 'show'])->name('result.show');
    Route::post('results',[ResultController::class, 'store'])->name('result.store');//listo
    Route::post('results/addresults',[ResultController::class, 'saveResults'])->name('result.saveresults');//listo
    Route::post('miJqueryAjax',[ResultController::class, 'return_results'])->name('result.traer');//listo
    Route::get('results/{result}/edit',[ResultController::class, 'edit'])->name('result.edit');
    Route::get('results/{result}/editresult',[ResultController::class, 'editResult'])->name('result.editResult');
    Route::put('results/{result}',[ResultController::class, 'update'])->name('result.update');
    Route::put('results/update/{result}',[ResultController::class, 'updateResult'])->name('result.updateResult');
    Route::delete('results/{result}',[ResultController::class, 'destroy'])->name('result.destroy');
});

Route::get('posts/{post}',[PostController::class, 'show'])->name('post.show');
Route::get('services',[ServiceController::class, 'index'])->name('service.index');
Route::get('services/{service}',[ServiceController::class, 'show'])->name('service.show');