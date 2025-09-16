<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
         try {

            Log::info('Datos recibidos:', $request->all());

            Attendance::create([
                'student_id' => $request->student_id,
                'date' => Carbon::now()->toDateString(),
                'time' => Carbon::now()->format('H:i:s'),
            ]);

            $student= Student::find($request->student_id);
            return response()->json(['student' => $student->name]);

        } catch (\Exception $e) {
            Log::error('❌ Error al guardar asistencia: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'No se pudo registrar la asistencia'], 500);
        }
    }
}
