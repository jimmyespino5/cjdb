<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AttendanceController extends Controller
{
    use ValidatesRequests;
    public function register(){
        
        return view('attendance.register', [
        //   //  'players'=>$players,
        //     'categories' => $categories,
        //     'teams'=>$teams,
             'user'=> auth()->user(),
        ]);
    }


    public function store(Request $request){
        $this->validate($request, [
            'student_id'=> 'required',
        ]);
        Attendance::create([
            'student_id' => $request->name,
            'date' => $request->year_init,
            'time' => $request->year_finish,
        ]);
        return back();
    }
}
