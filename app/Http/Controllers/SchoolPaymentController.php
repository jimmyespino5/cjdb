<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolPaymentController extends Controller
{
    public function index() {
        return view('school.payment', [
            'user'=> auth()->user(),
        ]);
    }
}
