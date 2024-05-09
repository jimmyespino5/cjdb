<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    use ValidatesRequests;
    public function index(){
        return view('auth.login');
    }
    
    public function store(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }
       $user = auth()->user(); 
        // return redirect()->route('dashboard', ['user'=>auth()->user()]);
        return view('dashboard', [
            'user'=>$user,
        ]);
    }
}
