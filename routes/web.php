<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/','PostController@index')->name('index');//este es para el inicio de la pagina
Route::get('/quienessomos',function(){return view('principal.nosotros');})->name('nosotros');
Route::get('/historia',function(){return view('principal.historia');})->name('historia');
Route::get('/ubicacion',function(){return view('principal.ubicacion');})->name('ubicacion');
Route::get('positions/PublicTableFutsal','PositionController@public_table_futsal')->name('position.public_table_futsal');
Route::get('players/goleadores_public','PlayerController@goleadores_public')->name('player.goleadores_public');

Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home');
//Rutas para autenticacion
Route::group(['middleware'=>'verified'],function(){ //Aca van las rutas que necesitan estar logueados 
    
    //Rutas Post
    Route::get('posts','PostController@list')->name('post.list');
    Route::get('posts/create','PostController@create')->name('post.create');
    Route::post('posts','PostController@store')->name('post.store');
    Route::get('posts/{post}/edit','PostController@edit')->name('post.edit');
    Route::put('posts/{post}','PostController@update')->name('post.update');
    Route::delete('posts/{post}','PostController@destroy')->name('post.destroy');
    
    //Rutas Service
    Route::get('services/create','ServiceController@create')->name('service.create');
    Route::get('services/list','ServiceController@list')->name('service.list');
    Route::post('services','ServiceController@store')->name('service.store');
    Route::get('services/{service}/edit','ServiceController@edit')->name('service.edit');
    Route::put('services/{service}','ServiceController@update')->name('service.update');
    Route::delete('services/{service}','ServiceController@destroy')->name('service.destroy');
    
    //Rutas Team
    Route::get('teams','TeamController@index')->name('team.index');//Muestra listado de equipos y opcion Ver Mas
    Route::get('teams/list','TeamController@list')->name('team.list');//ADMIN Listado de equipos
    Route::get('teams/create','TeamController@create')->name('team.create');
    Route::get('teams/{team}','TeamController@show')->name('team.show');
    Route::post('teams','TeamController@store')->name('team.store');
    Route::get('teams/{team}/edit','TeamController@edit')->name('team.edit');
    Route::put('teams/{team}','TeamController@update')->name('team.update');
    Route::delete('teams/{team}','TeamController@destroy')->name('team.destroy');
    
    //Rutas Player
    Route::get('players','PlayerController@index')->name('player.index');
    Route::get('players/list','PlayerController@list')->name('player.list');
    Route::get('players/listTeam','PlayerController@list_team')->name('player.list_team');
    Route::get('players/goleadores','PlayerController@goleadores')->name('player.goleadores');
    Route::get('players/create','PlayerController@create')->name('player.create');
    Route::get('players/{player}','PlayerController@show')->name('player.show');
    Route::post('players','PlayerController@store')->name('player.store');
    Route::get('players/{player}/edit','PlayerController@edit')->name('player.edit');
    Route::put('players/{player}','PlayerController@update')->name('player.update');
    Route::delete('players/{player}','PlayerController@destroy')->name('player.destroy');
    
    //Rutas Position 
    Route::get('positions','PositionController@index')->name('position.index');
    Route::get('positions/table','PositionController@index_table')->name('position.index_table');
    Route::get('positions/create','PositionController@create')->name('position.create');
    Route::get('positions/{position}','PositionController@show')->name('position.show');
    Route::post('positions','PositionController@store')->name('position.store');
    Route::get('positions/{position}/edit','PositionController@edit')->name('position.edit');
    Route::put('positions/{position}','PositionController@update')->name('position.update');
    Route::delete('positions/{position}','PositionController@destroy')->name('position.destroy');
    
    //Rutas Result 
    Route::get('results','ResultController@index')->name('result.index');//listo
    Route::get('resultsList','ResultController@indexAdmin')->name('result.listAdmin');//listo
    Route::get('results/myresults','ResultController@listMyResults')->name('result.listMyResults');//listo
    Route::get('results/addresults','ResultController@addresults')->name('result.addresults');//listo
    Route::get('results/create','ResultController@create')->name('result.create');//listo
    Route::get('results/{result}','ResultController@show')->name('result.show');
    Route::post('results','ResultController@store')->name('result.store');//listo
    Route::post('results/addresults','ResultController@saveResults')->name('result.saveresults');//listo
    Route::post('miJqueryAjax','ResultController@return_results')->name('result.traer');//listo
    Route::get('results/{result}/edit','ResultController@edit')->name('result.edit');
    Route::get('results/{result}/editresult','ResultController@editResult')->name('result.editResult');
    Route::put('results/{result}','ResultController@update')->name('result.update');
    Route::put('results/update/{result}','ResultController@updateResult')->name('result.updateResult');
    Route::delete('results/{result}','ResultController@destroy')->name('result.destroy');
});

Route::get('posts/{post}','PostController@show')->name('post.show');
Route::get('services','ServiceController@index')->name('service.index');
Route::get('services/{service}','ServiceController@show')->name('service.show');