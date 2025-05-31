<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Student([
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'gender' => $row['gender'],
            'address' => $row['address'],
            'contact' => $row['contact'],
            'age' => $row['age'],
            'course_id' => $row['course_id'],
            'year_level' => $row['year_level'],
            'school_year' => $row['school_year'],
            'status' => 'Enrolled',
            'password' => bcrypt($row['password']), // assuming password is in the file

            
        ]);
    }
}
