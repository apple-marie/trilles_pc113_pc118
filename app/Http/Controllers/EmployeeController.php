<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function employee()
    {
        return response()->json(Employee::all());
            
    }
    public function search(Request $request)
    {
        $search = $request->get('searchlist');
       $employee = Employee::where('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('id', 'like', '%'.$search.'%')->get();


        return response()->json([
            'employee' => $employee,
        ]);
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|string|min:8',
        ]);

        $employee = Employee::create($validatedData);
        return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $employee = employee::find($id);
        if (is_null($employee)) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validatedData = $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email|unique:employees,email,'.$id,
            'password' => 'nullable',
        ]);

        $employee->update($validatedData);
        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $employee,
        ]);
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        $employee->delete();
        return response()->json([
            'message' => 'Employee deleted successfully',
        ]);
    }
    public function login(Request $request){
        $employee = Employee::where('email', $request->email)->first();
        if($employee){
            $token = $employee->createToken('token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'employee' => $employee
            ]);
        }else{
            return response()->json([
                'message' => 'Login failed'
            ]);
        }
    }
}