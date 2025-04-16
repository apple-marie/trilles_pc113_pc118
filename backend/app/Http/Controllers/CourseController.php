<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    public function getCourse()
    {
        return response()->json(Course::all());
    }

    public function create(Request $request)
    {
        try{
            $validate = $request->validate([
                'course_name' => 'required|string',
                'description' => 'required',
            ]);
            $course = Course::create($validate);
            return response()->json([
                'message' => 'Course created successfully',
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $validated = $request->validate([
            'course_name' => 'required|string',
            'description' => 'required',
        ]);
        $course->update($validated);
        return response()->json([
            'message' =>'Course updated successfully',
            'course' => $course,
        ]);
    }

    public function delete(Request $request)
    {
        $course = Course::find($request->id);
        if($course){
            $course->delete();
            return response()->json([
                'message' => 'Course deleted successfully',
            ]);
        }
    }
}
