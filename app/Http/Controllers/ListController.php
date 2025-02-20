<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;

class ListController extends Controller
{
    public function index()
    {
        return response()->json(Student::all());
            
    }

    public function employee()
    {
        return response()->json(Employee::all());
            
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
       $student = Student::where('first_name', 'like', '%'.$search.'%')->get();
       $employee = Employee::where('first_name', 'like', '%'.$search.'%')->get();

        return response()->json([
            'student' => $students,
            'employee' => $employees,
        ]);

    }
    
    public function find($id)
    {
        return response()->json(Student::find($id));
    }
}
