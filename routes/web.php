<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
// Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/{user:name}', function () { return view('dashboard'); })->name('dashboard');