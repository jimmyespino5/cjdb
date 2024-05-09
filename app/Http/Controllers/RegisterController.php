<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RegisterController extends Controller
{
    use ValidatesRequests;
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);
        //Validacion
        $this->validate($request, [
            'name' => 'required|max:30',
            'cedula' => 'required|unique:users|min:5|max:8',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'cedula' => $request->cedula,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Autenticar Usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        //otra forma de autenticar
            auth()->attempt($request->only('email','password'));
            
        //Redireccionar
        return view('dashboard',['user'=> $user]);
    }
}
