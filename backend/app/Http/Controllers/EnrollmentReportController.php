<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EnrollmentReportController extends Controller
{
    public function byYear() {
        $student = Student::select('year_level', DB::raw('count(*) as total'))
        ->groupBy('year_level')
        ->orderByRaw("FIELD(year_level, 'First Year', 'Second Year', 'Third Year', 'Fourth Year')") //mo sort by year level
        ->get();

        return response()->json([
            'student' => $student,
        ]);
    }

    public function byCourseAndYearLevel() {
        $report = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->select('courses.course_name', 'students.year_level', DB::raw('count(students.id) as total'))
            ->groupBy('courses.course_name', 'students.year_level')
            ->orderBy('courses.course_name')
            ->orderByRaw("FIELD(students.year_level, 'first year', 'second year', 'third year', 'fourth year')")
            ->get();
    
        return response()->json([
            'course_year_report' => $report,
        ]);
    }

    public function export() {
        $report = DB::table('students')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->select('courses.course_name', 'students.year_level', DB::raw('count(students.id) as total'))
            ->groupBy('courses.course_name', 'students.year_level')
            ->orderBy('courses.course_name')
            ->orderByRaw("FIELD(students.year_level, 'first year', 'second year', 'third year', 'fourth year')")
            ->get();

        $csvFileName = 'enrollment_report.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Course Name', 'Year Level', 'Total Students']);

        foreach ($report as $row) {
            fputcsv($handle, [$row->course_name, $row->year_level, $row->total]);
        }

        // fclose($handle);
        
        return response()->stream(
            function () use ($handle) {
                fclose($handle);
            },
            200,
            $headers
        );
    }

    
    
    

}
