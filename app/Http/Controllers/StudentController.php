<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Student;
use Illuminate\Http\Request;
use App\Transformers\StudentTransformer;
use Auth;


class StudentController extends Controller
{
     public function add(Request $request, Student $student) {
        
        $this->validate($request, [
                'name' => 'required|min:10',
                 'fathername' => 'required|min:10',
                  'class' => 'required|min:10',
            ]);

        $newStudent = $student->create([
            'name' => $request->name,
            'fathername' => $request->fathername,
             'class' => $request->class,
            ]);
          print_r($newStudent);
          exit();
        $response =  fractal()
        ->item($newStudent)
        ->transformWith(new StudentTransformer)
        ->toArray();

        return response()->json($response, 201);
    }

      public function update(Request $request, Student $student) {
        $this->authorize('update', $student);

       $student->name = $request->get('name', $student->name);
        $student->fathername = $request->get('fathername', $student->fathername);
         $student->class = $request->get('class', $student->class);
       $student->save();

       return fractal()
       ->item($student)
       ->transformWith(new StudentTransformer)
       ->toArray();
    }

    public function delete(Student $student) {
        $this->authorize('delete', $student);

        $student->delete();

        return response()->json([
            'message' => 'student deleted'
            ]);
    }
}
