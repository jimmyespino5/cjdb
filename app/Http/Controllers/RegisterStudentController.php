<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RegisterStudentController extends Controller
{
    use ValidatesRequests;

    public function index() {
        $teams = Team::where("area",2);
        return view('school.registerstu', [
            'user'=> auth()->user(),
            'teams'=> $teams,
        ]);
    }

    public function store(){

    }
}
