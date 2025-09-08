<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        
        return view('school.lists', [
            'user'=> auth()->user(),
        ]);
    }
}
