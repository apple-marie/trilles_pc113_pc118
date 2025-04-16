<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;


class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::with('course')->get());
    }

    public function search(Request $request)
    {
        $search = $request->get('searchlist');
        $student = Student::where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')->get();

        return response()->json([
            'student' => $student,
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'age' => 'required',
            'course_id' => 'required|exists:courses,id',
            'year_level' => 'required|integer',
        ]);

        $student = Student::create($validatedData);
        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student,
        ], 201);
    }

    public function update(Request $request,$id)
    {
        $student = Student::find($request->id);
        if (is_null($student)) {
            return response()->json([
                'message' => 'Student not found',
                'data' => $request->id
            ]);
        }

        $validatedData = $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'age' => 'integer',
            'course_id' => 'exists:courses,id',
            'year_level' => 'integer',
        
        ]);

        $student->update($validatedData);
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student,
        ]);
        }


    public function delete(Request $request)
    {
        $student = Student::find($request->id);
        if (is_null($student)) {
            return response()->json(['message' => 'Student not found']);
        }
        $student->delete();
        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }
    public function login(Request $request){
        $student = Student::where('email', $request->email)->first();
        if($student){
            $token = $student->createToken('token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'student' => $student,
            ]);
        }else{
            return response()->json([
                'message' => 'Login failed'
            ]);
        }
    }


    public function show($id) {
        $student = Student::find($id);
        return response()->json([
            'student' => $student,

        ]);
    }



    
}