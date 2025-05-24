<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Mail\StudentCredentials;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


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
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:10240',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'age' => 'required',
            'gender' => 'required',
            'course_id' => 'required',
            'year_level' => 'required',
            'school_year' => 'required',
        ]);
        $validatedData['status'] = 'Enrolled';
        $validatedData['password'] = Hash::make($request->password);



        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $validatedData['image'] = $path;

        }
        $student = Student::create($validatedData);
        Mail::to($student->email)->send(new StudentCredentials($student->id , $student->first_name));
        
        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student,
        ], 201);
    }

    public function getStudent(Request $request)
    {
        $student = Student::with('course')->where('id', $request->id)->first();
        if (is_null($student)) {
            return response()->json(['message' => 'Student not found']);
        }
        return response()->json([
            'student' => $student,
        ]);
    }

    public function update(Request $request)
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
            'middle_name' => 'string|nullable',
            'last_name' => 'string',
            'address' => 'string',
            'contact' => 'string',
            'image' => 'mimes:jpeg,png,jpg,gif|max:10240',
            'email' => 'email|nullable',
            'age' => 'nullable',
            'gender' => 'string|nullable',
            'course_id' => 'nullable',
            'year_level' => 'string|nullable',
            'school_year' => 'string|nullable',
            'status' => 'string|nullable',
        
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $validatedData['image'] = $path;
        }

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

    public function setupStudent(Request $request) {
        $student = Student::with('course')->where('id', $request->id)->first();
        return response()->json($student);
    }



    
}