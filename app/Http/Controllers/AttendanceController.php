<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        
        Attendance::create([
             'student_id' => $request->student_id,
             'date' => Carbon::now()->toDateString(),
             'time' => Carbon::now()->format('H:i:s'),
         ]);
        // DB::table('attendances')->insert([
        //     'student_id' => $request->student_id,
        //     'date' => Carbon::now()->toDateString(),
        //     'time' => Carbon::now()->format('H:i:s'),
        // ]);

        return response()->json(['status' => 'ok']);
    }
}
