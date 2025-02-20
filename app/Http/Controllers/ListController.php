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
}
