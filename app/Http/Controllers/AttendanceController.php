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
            $registrado = 0;
            $existe = Attendance::where('student_id',$request->student_id)
                                ->where('date',Carbon::now()->toDateString())->get()->first();
//            Log::info('Datos recibidos:', $request->all());
            Log::info('Datos de estudiante:', $existe);
            if ($existe) {
                $registrado = 1;
            } else {
                Attendance::create([
                    'student_id' => $request->student_id,
                    'date' => Carbon::now()->toDateString(),
                    'time' => Carbon::now()->format('H:i:s'),
                ]);
            }
            

            $student= Student::find($request->student_id);
            return response()->json(['name' => $student->name, 'lastname' => $student->lastname, 'registrado' => $registrado]);

        } catch (\Exception $e) {
            Log::error('❌ Error al guardar asistencia: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'No se pudo registrar la asistencia'], 500);
        }
    }
}
